<?php

declare(strict_types=1);

/**
 * HTML_TreeMenu Package
 * 
 * A tree menu implementation for PHP 8.3+
 * 
 * @package HTML_TreeMenu
 * @author Richard Heyes <richard@php.net>
 * @author Harald Radi <harald.radi@nme.at>
 * @license BSD-3-Clause
 */

/**
 * HTML_TreeMenu Class
 *
 * A tree menu implementation that produces hierarchical navigation.
 * Supports dynamic collapsible branches in modern browsers.
 *
 * @package HTML_TreeMenu
 */
class HTML_TreeMenu
{
    /**
     * Indexed array of subnodes
     */
    public array $items = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        // Initialize empty items array
    }

    /**
     * Adds an item to the tree
     *
     * @param HTML_TreeNode $node The node to add
     * @return HTML_TreeNode Returns a reference to the new node inside the tree
     */
    public function addItem(HTML_TreeNode $node): HTML_TreeNode
    {
        $this->items[] = $node;
        return $this->items[array_key_last($this->items)];
    }

    /**
     * Import method for creating HTML_TreeMenu objects from existing tree structures
     *
     * @param array $params Configuration parameters:
     *                      - structure: The tree structure
     *                      - type: Structure type ('heyes', 'heyes_array', 'kriesing')
     *                      - nodeOptions: Default options for each node
     *                      - treeMenu: Existing tree menu (for recursion)
     *                      - parentID: Parent ID (for recursion)
     * @return HTML_TreeMenu The resulting HTML_TreeMenu object
     */
    public static function createFromStructure(array $params): HTML_TreeMenu
    {
        $params['nodeOptions'] ??= [];
        $type = $params['type'] ?? 'heyes';

        switch ($type) {
            case 'kriesing':
                return self::createFromKriesing($params);
            
            case 'heyes_array':
                return self::createFromHeyesArray($params);
            
            case 'heyes':
            default:
                return self::createFromHeyes($params);
        }
    }

    /**
     * Creates tree from Kriesing structure
     */
    private static function createFromKriesing(array $params): HTML_TreeMenu
    {
        $className = strtolower(get_class($params['structure']->dataSourceClass));
        $isXMLStruct = str_contains($className, '_xml');

        $nodes = $params['structure']->getNode();
        $treeMenu = new HTML_TreeMenu();
        $curNode = [0 => $treeMenu];

        foreach ($nodes as $aNode) {
            $events = [];
            $data = [];

            // Handle XML attributes
            if ($isXMLStruct && !empty($aNode['attributes'])) {
                foreach ($aNode['attributes'] as $key => $val) {
                    if (!isset($aNode[$key])) {
                        $aNode[$key] = $val;
                    }
                }
            }

            // Process data and events
            foreach ($aNode as $key => $val) {
                if (!is_array($val)) {
                    if (str_starts_with($key, 'on')) {
                        $events[$key] = $val;
                    }
                    $data[$key] = $val;
                }
            }

            $data['text'] = $aNode['text'] ?? $aNode['name'] ?? '';

            $thisNode = $curNode[$aNode['level']]->addItem(new HTML_TreeNode($data, $events));
            $curNode[$aNode['level'] + 1] = $thisNode;
        }

        return $treeMenu;
    }

    /**
     * Creates tree from Heyes array structure
     */
    private static function createFromHeyesArray(array $params): HTML_TreeMenu
    {
        if (!isset($params['treeMenu'])) {
            $treeMenu = new HTML_TreeMenu();
            $parentID = 0;
        } else {
            // If treeMenu is a TreeNode (during recursion), work with it directly
            if ($params['treeMenu'] instanceof HTML_TreeNode) {
                $parentNode = $params['treeMenu'];
                $parentID = $params['parentID'];
                
                foreach ($params['structure']->getChildren($parentID) as $nodeID) {
                    $data = $params['structure']->getData($nodeID);
                    $childNode = $parentNode->addItem(
                        new HTML_TreeNode(array_merge($params['nodeOptions'], $data))
                    );

                    if ($params['structure']->hasChildren($nodeID)) {
                        self::createFromStructure([
                            'type' => 'heyes_array',
                            'parentID' => $nodeID,
                            'nodeOptions' => $params['nodeOptions'],
                            'structure' => $params['structure'],
                            'treeMenu' => $childNode
                        ]);
                    }
                }
                
                // Return the root tree menu by traversing up
                $root = $parentNode;
                while ($root->parent !== null) {
                    $root = $root->parent;
                }
                
                // Create a new TreeMenu and add the root node
                $treeMenu = new HTML_TreeMenu();
                $treeMenu->items[] = $root;
                return $treeMenu;
            } else {
                $treeMenu = $params['treeMenu'];
                $parentID = $params['parentID'];
            }
        }

        foreach ($params['structure']->getChildren($parentID) as $nodeID) {
            $data = $params['structure']->getData($nodeID);
            $parentNode = $treeMenu->addItem(
                new HTML_TreeNode(array_merge($params['nodeOptions'], $data))
            );

            if ($params['structure']->hasChildren($nodeID)) {
                self::createFromStructure([
                    'type' => 'heyes_array',
                    'parentID' => $nodeID,
                    'nodeOptions' => $params['nodeOptions'],
                    'structure' => $params['structure'],
                    'treeMenu' => $parentNode
                ]);
            }
        }

        return $treeMenu;
    }

    /**
     * Creates tree from Heyes OO structure
     */
    private static function createFromHeyes(array $params): HTML_TreeMenu
    {
        $treeMenu = $params['treeMenu'] ?? new HTML_TreeMenu();
        
        // If we received a TreeNode instead of TreeMenu during recursion, handle it
        if ($treeMenu instanceof HTML_TreeNode) {
            $parentNode = $treeMenu;
            
            foreach ($params['structure']->nodes->nodes as $node) {
                $tag = $node->getTag();
                $childNode = $parentNode->addItem(
                    new HTML_TreeNode(array_merge($params['nodeOptions'], $tag))
                );

                if (!empty($node->nodes->nodes)) {
                    self::createFromStructure([
                        'structure' => $node,
                        'nodeOptions' => $params['nodeOptions'],
                        'treeMenu' => $childNode
                    ]);
                }
            }
            
            // Return the root tree menu by traversing up
            $root = $parentNode;
            while ($root->parent !== null) {
                $root = $root->parent;
            }
            
            // Create a new TreeMenu and add the root node
            $rootMenu = new HTML_TreeMenu();
            $rootMenu->items[] = $root;
            return $rootMenu;
        }

        foreach ($params['structure']->nodes->nodes as $node) {
            $tag = $node->getTag();
            $parentNode = $treeMenu->addItem(
                new HTML_TreeNode(array_merge($params['nodeOptions'], $tag))
            );

            if (!empty($node->nodes->nodes)) {
                self::createFromStructure([
                    'structure' => $node,
                    'nodeOptions' => $params['nodeOptions'],
                    'treeMenu' => $parentNode
                ]);
            }
        }

        return $treeMenu;
    }

    /**
     * Creates a treeMenu from XML
     *
     * @param string|object $xml XML string or XML_Tree object
     * @return HTML_TreeMenu The HTML_TreeMenu object
     * @throws RuntimeException If Tree class is not available
     */
    public function createFromXML(string|object $xml): HTML_TreeMenu
    {
        if (!class_exists('Tree')) {
            throw new RuntimeException('Tree class not found. Please include the Tree class.');
        }

        if (is_string($xml)) {
            if (!class_exists('XML_Tree')) {
                throw new RuntimeException('XML_Tree class not found. Please include XML/Tree.php');
            }
            $xmlTree = new XML_Tree();
            $xmlTree->getTreeFromString($xml);
        } else {
            $xmlTree = $xml;
        }

        $treeStructure = Tree::createFromXMLTree($xmlTree, true);
        $treeStructure->nodes->traverse(function($node) {
            $tagData = $node->getTag();
            $node->setTag($tagData["attributes"] ?? []);
        });

        return self::createFromStructure(['structure' => $treeStructure]);
    }
}

/**
 * HTML_TreeNode class
 *
 * Represents a single node in the tree menu structure
 *
 * @package HTML_TreeMenu
 */
class HTML_TreeNode
{
    public string $text = '';
    public string $link = '';
    public string $icon = '';
    public string $expandedIcon = '';
    public string $cssClass = '';
    public ?string $linkTarget = null;
    public array $items = [];
    public bool $expanded = false;
    public bool $isDynamic = true;
    public bool $ensureVisible = false;
    public ?HTML_TreeNode $parent = null;
    public array $events = [];

    /**
     * Constructor
     *
     * @param array $options Node configuration options
     * @param array $events JavaScript event handlers
     */
    public function __construct(array $options = [], array $events = [])
    {
        $this->events = $events;

        foreach ($options as $option => $value) {
            if (is_string($option) && property_exists($this, $option)) {
                $this->setOption($option, $value);
            }
        }
    }

    /**
     * Sets an option after construction
     *
     * @param string $option Option name
     * @param mixed $value Option value
     * @throws InvalidArgumentException If option doesn't exist
     */
    public function setOption(string $option, mixed $value): void
    {
        if (!property_exists($this, $option)) {
            throw new InvalidArgumentException("Option '{$option}' does not exist");
        }

        // Type conversion for boolean properties
        if ($option === 'expanded' || $option === 'isDynamic' || $option === 'ensureVisible') {
            $this->$option = (bool) $value;
        } else {
            $this->$option = $value;
        }
    }

    /**
     * Adds a new subnode to this node
     *
     * @param HTML_TreeNode $node The new node
     * @return HTML_TreeNode The new node
     */
    public function addItem(HTML_TreeNode $node): HTML_TreeNode
    {
        $node->parent = $this;
        $this->items[] = $node;

        if ($node->ensureVisible) {
            $this->ensureVisible();
        }

        return $this->items[array_key_last($this->items)];
    }

    /**
     * Handles ensureVisible functionality
     */
    private function ensureVisible(): void
    {
        $this->ensureVisible = true;
        $this->expanded = true;

        $this->parent?->ensureVisible();
    }
}

/**
 * Base presentation class for tree menu rendering
 *
 * @package HTML_TreeMenu
 */
abstract class HTML_TreeMenu_Presentation
{
    protected HTML_TreeMenu $menu;

    /**
     * Constructor
     *
     * @param HTML_TreeMenu $structure The menu structure
     */
    public function __construct(HTML_TreeMenu $structure)
    {
        $this->menu = $structure;
    }

    /**
     * Prints the HTML generated by the toHTML() method
     *
     * @param array $options Display options
     */
    public function printMenu(array $options = []): void
    {
        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }

        echo $this->toHTML();
    }

    /**
     * Abstract method to generate HTML
     *
     * @return string Generated HTML
     */
    abstract public function toHTML(): string;
}

/**
 * DHTML presentation class for tree menu
 *
 * @package HTML_TreeMenu
 */
class HTML_TreeMenu_DHTML extends HTML_TreeMenu_Presentation
{
    public bool $isDynamic = true;
    public string $images = 'images';
    public string $linkTarget = '_self';
    public bool $usePersistence = true;
    public string $defaultClass = '';
    public bool $noTopLevelImages = false;
    public string $jsObjectName = 'objTreeMenu';
    public int $maxDepth = 0;

    private static int $instanceCount = 0;

    /**
     * Constructor
     *
     * @param HTML_TreeMenu $structure The menu structure
     * @param array $options Display options
     * @param bool $isDynamic Whether the tree is dynamic
     */
    public function __construct(HTML_TreeMenu $structure, array $options = [], bool $isDynamic = true)
    {
        parent::__construct($structure);
        $this->isDynamic = $isDynamic;

        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }

    /**
     * Returns the HTML for the menu
     *
     * @return string The HTML for the menu
     */
    public function toHTML(): string
    {
        $menuObj = $this->jsObjectName . '_' . (++self::$instanceCount);

        $html = "\n<script type=\"text/javascript\">\n//<![CDATA[\n";
        $html .= sprintf(
            "\t%s = new TreeMenu(\"%s\", \"%s\", \"%s\", \"%s\", %s, %s);\n",
            $menuObj,
            $this->images,
            $menuObj,
            $this->linkTarget,
            $this->defaultClass,
            $this->usePersistence ? 'true' : 'false',
            $this->noTopLevelImages ? 'true' : 'false'
        );

        if (!empty($this->menu->items)) {
            foreach ($this->menu->items as $item) {
                $html .= $this->nodeToHTML($item, $menuObj);
            }
        }

        $html .= sprintf("\n\t%s.drawMenu();", $menuObj);
        $html .= sprintf("\n\t%s.writeOutput();", $menuObj);

        if ($this->usePersistence && $this->isDynamic) {
            $html .= sprintf("\n\t%s.resetBranches();", $menuObj);
        }

        $html .= "\n// ]]>\n</script>\n";

        return $html;
    }

    /**
     * Generates HTML for a single node
     *
     * @param HTML_TreeNode $nodeObj The node object
     * @param string $prefix JavaScript prefix
     * @param string $return Variable name for the node
     * @param int $currentDepth Current depth in the tree
     * @param string|null $maxDepthPrefix Prefix for max depth handling
     * @return string HTML for the node
     */
    private function nodeToHTML(
        HTML_TreeNode $nodeObj,
        string $prefix,
        string $return = 'newNode',
        int $currentDepth = 0,
        ?string $maxDepthPrefix = null
    ): string {
        $prefix = $maxDepthPrefix ?: $prefix;

        $expanded = $this->isDynamic ? ($nodeObj->expanded ? 'true' : 'false') : 'true';
        $isDynamic = $this->isDynamic ? ($nodeObj->isDynamic ? 'true' : 'false') : 'false';

        $html = sprintf(
            "\t%s = %s.addItem(new TreeNode('%s', %s, %s, %s, %s, '%s', '%s', %s));\n",
            $return,
            $prefix,
            addslashes($nodeObj->text),
            $nodeObj->icon ? "'" . $nodeObj->icon . "'" : 'null',
            $nodeObj->link ? "'" . $nodeObj->link . "'" : 'null',
            $expanded,
            $isDynamic,
            $nodeObj->cssClass,
            $nodeObj->linkTarget ?? $this->linkTarget,
            $nodeObj->expandedIcon ? "'" . $nodeObj->expandedIcon . "'" : 'null'
        );

        foreach ($nodeObj->events as $event => $handler) {
            $html .= sprintf(
                "\t%s.setEvent('%s', '%s');\n",
                $return,
                $event,
                addslashes(str_replace(["\r", "\n"], ['\r', '\n'], $handler))
            );
        }

        if ($this->maxDepth > 0 && $currentDepth === $this->maxDepth) {
            $maxDepthPrefix = $prefix;
        }

        if (!empty($nodeObj->items)) {
            foreach ($nodeObj->items as $i => $item) {
                $html .= $this->nodeToHTML(
                    $item,
                    $return,
                    $return . '_' . ($i + 1),
                    $currentDepth + 1,
                    $maxDepthPrefix
                );
            }
        }

        return $html;
    }
}

/**
 * Listbox presentation class for tree menu
 *
 * @package HTML_TreeMenu
 */
class HTML_TreeMenu_Listbox extends HTML_TreeMenu_Presentation
{
    public string $promoText = 'Select...';
    public string $indentChar = '&nbsp;';
    public int $indentNum = 2;
    public string $linkTarget = '_self';
    public string $submitText = 'Go';

    private static int $instanceCount = 0;

    /**
     * Constructor
     *
     * @param HTML_TreeMenu $structure The menu structure
     * @param array $options Display options
     */
    public function __construct(HTML_TreeMenu $structure, array $options = [])
    {
        parent::__construct($structure);

        foreach ($options as $option => $value) {
            if (property_exists($this, $option)) {
                $this->$option = $value;
            }
        }
    }

    /**
     * Returns the HTML generated
     *
     * @return string HTML for the listbox
     */
    public function toHTML(): string
    {
        $selectName = 'HTML_TreeMenu_Listbox_' . (++self::$instanceCount);
        $nodeHTML = '';

        if (!empty($this->menu->items)) {
            foreach ($this->menu->items as $item) {
                $nodeHTML .= $this->nodeToHTML($item);
            }
        }

        return sprintf(
            '<form target="%s" action="" onsubmit="var link = this.%s.options[this.%s.selectedIndex].value; if (link) {this.action = link; return true} else return false">' .
            '<select name="%s">' .
            '<option value="">%s</option>%s' .
            '</select> ' .
            '<input type="submit" value="%s" />' .
            '</form>',
            htmlspecialchars($this->linkTarget),
            htmlspecialchars($selectName),
            htmlspecialchars($selectName),
            htmlspecialchars($selectName),
            htmlspecialchars($this->promoText),
            $nodeHTML,
            htmlspecialchars($this->submitText)
        );
    }

    /**
     * Returns HTML for a single node
     *
     * @param HTML_TreeNode $node The node
     * @param string $prefix Prefix for indentation
     * @return string HTML for the node
     */
    private function nodeToHTML(HTML_TreeNode $node, string $prefix = ''): string
    {
        $html = sprintf(
            '<option value="%s">%s%s</option>',
            htmlspecialchars($node->link),
            $prefix,
            htmlspecialchars($node->text)
        );

        if (!empty($node->items)) {
            $newPrefix = $prefix . str_repeat($this->indentChar, $this->indentNum);
            foreach ($node->items as $item) {
                $html .= $this->nodeToHTML($item, $newPrefix);
            }
        }

        return $html;
    }
}