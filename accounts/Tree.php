<?php
//include("../db/db.php"); 

/**
* An OO tree class based on various things, including the MS treeview control
* If you use this class and wish to show your appreciation then visit my
* wishlist here:   http://www.amazon.co.uk/exec/obidos/wishlist/S8H2UOGMPZK6
*
* Structure of one of these trees:
*
*  Tree Object
*    |
*    +- Tree_NodeCollection object (nodes property)
*          |
*          +- Array of Tree_Node objects (nodes property)
*
* Usage:
*   $tree = new Tree();
*   $node  = $tree->nodes->addNode(new Tree_Node('1'));
*   $node2 = $tree->nodes->addNode(new Tree_Node('2'));
*   $node3 = $tree->nodes->addNode(new Tree_Node('3'));
*   $node4 = $node3->nodes->addNode(new Tree_Node('3_1'));
*   $tree->nodes->removeNodeAt(0);
*   print_r($tree);
* 
* The data for a node is supplied by giving it as the argument to the Tree_Node
* constructor. You can retreive the data by using a nodes getTag() method, and alter
* it using the setTag() method.
*
* Public methods for Tree class:
*   createFromList(array data [, string separator])   (static) Returns a tree structure create from the supplied list
*   createFromMySQL(array $params)                    (static) Returns a tree structure created using a common DB storage technique
*
* Public methods for Tree_Node class:
*   setTag(mixed tag)                                 Sets the tag data
*   getTag()                                          Retreives the tag data
*   prevSibling()                                     Retreives the previous sibling node
*   nextSibling()                                     Retreives the next sibling node
*   remove()                                          Removes this node from the collection
*   
* Public variables for Tree_Node class:
*   $nodes
*
* Public methods for Tree_NodeCollection class:
*   addNode(Tree_Node node)                           Adds a node to the collection
*   firstNode()                                       Retreives the first node in the collection
*   lastNode()                                        Retreives the last node in the collection
*   removeNodeAt(int index)                           Removes the node at the specified index (nodes are re-ordered)
*   removeNode(Tree_Node node [, bool search])        Removes the given node (nodes are re-ordered)
*   indexOf(Tree_Node node)                            Retreives the index of the given node
*   getNodeCount([bool recurse])                      Retreives the number of nodes in the collection, optionally recursing
*   getFlatList()                                      Retrieves an indexed array of the nodes from top to bottom, left to right
*   traverse(callable function)                       Traverses the tree supply each node to the callback function
*   search(mixed searchData [, bool strict])           Basic search function for searching the Trees' "tag" data
*/

class Tree
{
    /**
    * UID counter
    * @var int
    */
    public int $uidCounter;
    
    /**
    * Child nodes
    * @var Tree_NodeCollection
    */
    public Tree_NodeCollection $nodes;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->nodes = new Tree_NodeCollection($this);
        $this->uidCounter = 0;
    }
    
    /**
    * Creates a tree structure from a list of items.
    * Items must be separated using the supplied separator.
    * Eg:    array('foo',
    *              'foo/bar',
    *              'foo/bar/jello',
    *              'foo/bar/jello2',
    *              'foo/bar2/jello')
    *
    * Would create a structure thus:
    *   foo
    *    +-bar
    *    |  +-jello
    *    |  +-jello2
    *    +-bar2
    *       +-jello
    * 
    * Example code:
    *   $list = array('Foo/Bar/blaat', 'Foo', 'Foo/Bar', 'Foo/Bar/Jello', 'Foo/Bar/Jello2', 'Foo/Bar2/Jello/Jello2');
    *   $tree = Tree::createFromList($list);
    *
    * @param  array  $data      The list as an indexed array
    * @param  string $separator The separator to use
    * @return Tree              A tree structure (Tree object)
    */
    public static function createFromList(array $data, string $separator = '/'): Tree
    {
        $nodeList = [];
        $tree     = new Tree();

        foreach ($data as $item) {
            $pathParts = explode($separator, $item);

            // If only one part then add it as a root node if
            // it's not already present.
            if (count($pathParts) == 1) {
                if (!empty($nodeList[$pathParts[0]])) {
                    continue;
                } else {
                    $nodeList[$pathParts[0]] = new Tree_Node([$pathParts[0], $item]);
                    $tree->nodes->addNode($nodeList[$pathParts[0]]);
                }

            // Multiple parts means each part/parent combination
            // needs checking to see if it needs adding.
            } else {
                $parentObj = $tree;

                for ($j = 0; $j < count($pathParts); $j++) {
                    $currentPath = implode($separator, array_slice($pathParts, 0, $j + 1));
                    if (!empty($nodeList[$currentPath])) {
                        // Update parent object to be the existing node
                        $parentObj = $nodeList[$currentPath];
                        continue;
                    } else {
                        $nodeList[$currentPath] = new Tree_Node([$pathParts[$j], $currentPath]);
                        // Update parent object to be the new node
                        $parentObj = $parentObj->nodes->addNode($nodeList[$currentPath]);
                    }
                }
            }
        }
        
        return $tree;
    }
    
    /**
    * This method imports a tree from a database using the common
    * id/parent_id method of storing the structure. Example code:
    *
    * $tree = Tree::createFromMySQL(['host'     => 'localhost',
    *                                'user'     => 'root',
    *                                'pass'     => '',
    *                                'database' => 'treetest',
    *                                'query'    => 'SELECT id, parent_id, text, icon, expandedIcon FROM structure ORDER BY parent_id, id']);
    *
    * @param resource $conn Database connection resource
    * @return Tree         A tree structure created using a common DB storage technique
    */
    public static function createFromMySQL($conn): Tree
    {
        $tree     = new Tree();
        $nodeList = [];

        $query_acc = "select acccode as id, parent_acc as parent_id, acc_name as text , lpad(acccode,17,'gac.php?ac=') as link from accmast ORDER BY parent_id, id";

        // Perform query
        if ($result = pg_query($conn, $query_acc)) {
            if (pg_num_rows($result)) {
                // Loop thru results
                while ($row = pg_fetch_array($result)) {
                    // Parent id is 0, thus root node.
                    if (!$row['parent_id']) {
                        unset($row['parent_id']);
                        $nodeList[$row['id']] = new Tree_Node($row);
                        $tree->nodes->addNode($nodeList[$row['id']]);

                    // Parent node has already been added to tree
                    } elseif (!empty($nodeList[$row['parent_id']])) {
                        $parentNode = $nodeList[$row['parent_id']];
                        unset($row['parent_id']);
                        $nodeList[$row['id']] = new Tree_Node($row);
                        $parentNode->nodes->addNode($nodeList[$row['id']]);
                        
                    } else {
                        // Orphan node ?
                    }
                }
            }
        }
        
        return $tree;
    }
    
    /**
    * Merges two or more tree structures into one. Can take either 
    * Tree objects or Tree_Node objects as arguments to merge. This merge
    * simply means the nodes from the second+ argument(s) are added to
    * the first.
    *
    * @param Tree|Tree_Node $tree The Tree/Tree_Node object to merge subsequent
    *                             Tree/Tree_Node objects with.
    * @param ...                 Any number of Tree or Tree_Node objects to be merged
    *                             with the first argument.
    * @return Tree|Tree_Node      Resulting merged Tree/Tree_Node object
    */
    public function merge($tree)
    {
        $args = func_get_args();
        array_shift($args);

        foreach ($args as $arg) {
            foreach ($arg->nodes->nodes as $node) {
                $this->nodes->addNode($node);
            }
        }
        
        return $this;
    }
}


/**
* A node class to complement the above
* tree class
*/
class Tree_Node
{
    /**
    * The data that this node holds
    * @var mixed
    */
    public $tag;

    /**
    * Parent node
    * @var Tree_Node|null
    */
    public ?Tree_Node $parent = null;
    
    /**
    * The master Tree object
    * @var Tree|null
    */
    public ?Tree $tree = null;
    
    /**
    * The nodes collection
    * @var Tree_NodeCollection
    */
    public Tree_NodeCollection $nodes;

    /**
    * UID of the node
    * @var int|null
    */
    public ?int $uid = null;

    /**
    * Constructor
    *
    * @param mixed $tag The data that this node represents
    */
    public function __construct($tag = null)
    {
        $this->nodes = new Tree_NodeCollection($this);

        if ($tag !== null) {
            $this->tag = $tag;
        }
    }
    
    /**
    * Sets the tag data
    *
    * @param mixed $tag The data to set the tag to
    * @return void
    */
    public function setTag($tag): void
    {
        $this->tag = $tag;
    }
    
    /**
    * Returns the tag data
    *
    * @return mixed The tag data
    */
    public function getTag()
    {
        return $this->tag;
    }

    /**
    * Sets the nodes UID
    * 
    * @param int $uid The UID
    * @return void
    */
    public function setUID(int &$uid): void
    {
        $this->uid = ++$uid;

        // Set uid for child nodes
        foreach ($this->nodes->nodes as $node) {
            $node->setUID($uid);
        }
    }

    /**
    * Returns the node UID
    * 
    * @return int|null The UID
    */
    public function getUID(): ?int
    {
        return $this->uid;
    }

    /**
    * Returns the previous child node in the parents node array,
    * or null if this node is the first.
    *
    * @return Tree_Node|null A reference to the previous node in the parent
    *                        node collection
    */
    public function prevSibling(): ?Tree_Node
    {
        $parentObj = $this->parent ?? $this->tree;

        if ($parentObj === null) {
            return null;
        }

        $myIndex = $parentObj->nodes->indexOf($this);

        if ($myIndex > 0) {
            return $parentObj->nodes->nodes[$myIndex - 1];
        }

        return null;
    }

    /**
    * Returns the next child node in the parents node array,
    * or null if this node is the last.
    *
    * @return Tree_Node|null A reference to the next node in the parent
    *                        node collection.
    */
    public function nextSibling(): ?Tree_Node
    {
        $parentObj = $this->parent ?? $this->tree;

        if ($parentObj === null) {
            return null;
        }

        $myIndex = $parentObj->nodes->indexOf($this);

        if ($myIndex < ($parentObj->nodes->getNodeCount() - 1)) {
            return $parentObj->nodes->nodes[$myIndex + 1];
        }

        return null;
    }
    
    /**
    * Removes this node from its' parent. If this
    * node has no parent (ie its not been added to
    * a Tree or Tree_Node object) then this method
    * will do nothing.
    * @return void
    */
    public function remove(): void
    {
        if ($this->parent !== null) {
            $this->parent->nodes->removeNode($this);
        }
    }

    /**
    * Sets the master Tree object for this
    * node.
    *
    * @param Tree $tree The Tree object reference
    * @return void
    */
    public function setTree(Tree $tree): void
    {
        $this->tree = $tree;

        // Set tree for child nodes
        foreach ($this->nodes->nodes as $node) {
            $node->setTree($tree);
        }
    }

    /**
    * Sets the parent node of the node.
    *
    * @param Tree_Node $node The parent node
    * @return void
    */
    public function setParent(Tree_Node $node): void
    {
        $this->parent = $node;
    }
}

/**
* A class to represent a collection of child nodes
*/
class Tree_NodeCollection
{
    /**
    * An array of child nodes
    * @var array<int, Tree_Node>
    */
    public array $nodes = [];
    
    /**
    * The containing node/tree object
    * @var Tree|Tree_Node
    */
    public $container;
    
    /**
    * Whether the container is a tree object or not
    * @var bool
    */
    public bool $containerIsTree;
    
    /**
    * Whether the container is a tree node object or not
    * @var bool
    */
    public bool $containerIsNode;
	
	/**
    * Temporary holder for the found node used in the
	* search function.
	* @var Tree_Node|null
    */
	public ?Tree_Node $searchFoundNode = null;

    /**
    * Constructor
    *
    * @param Tree|Tree_Node $container
    */
    public function __construct($container)
    {
        $this->nodes = [];
        $this->container = $container;
        $this->containerIsTree = ($container instanceof Tree);
        $this->containerIsNode = ($container instanceof Tree_Node);
    }

    /**
    * Adds a node to this node
    *
    * @param  Tree_Node $node The Tree_Node object
    * @return Tree_Node       The new node inside the tree
    */
    public function addNode(Tree_Node $node): Tree_Node
    {
        // Container is a node
        if ($this->containerIsNode) {
            $node->setParent($this->container);
            
            if ($this->container->tree !== null) {
                $node->setTree($this->container->tree);
            }
            
            if ($this->container->uid !== null) {
                $node->setUID($this->container->tree->uidCounter);
            }

        // Container is a tree
        } else {
            $node->setTree($this->container);
            $node->setUID($this->container->uidCounter);
        }

        $this->nodes[] = $node;

        return $node;
    }

    /**
    * Returns the first node in this particular collection
    *
    * @return Tree_Node|null The first node. NULL if no nodes.
    */
    public function firstNode(): ?Tree_Node
    {
        return $this->nodes[0] ?? null;
    }
    
    /**
    * Returns the last node in this particular collection
    *
    * @return Tree_Node|null The last node. NULL if no nodes.
    */
    public function lastNode(): ?Tree_Node
    {
        if (empty($this->nodes)) {
            return null;
        }

        return $this->nodes[count($this->nodes) - 1];
    }

    /**
    * Removes a node from the child nodes array at the
    * specified (zero based) index.
    *
    * @param   int $index The index to remove
    * @return Tree_Node|null The node that was removed, or null
    *                        if this index did not exist
    */
    public function removeNodeAt(int $index): ?Tree_Node
    {
        if (!isset($this->nodes[$index])) {
            return null;
        }

        $node = $this->nodes[$index];

        // Unset parent, tree and uid values
        unset($node->uid);
        unset($node->parent);
        unset($node->tree);
        unset($this->nodes[$index]);
        $this->nodes = array_values($this->nodes);

        return $node;
    }
    
    /**
    * Removes a node from the child nodes array by using
    * the unique ID stored in each instance
    *
    * @param  Tree_Node $node   The node to remove
    * @param  bool      $search Whether to search child nodes
    * @return bool              True/False
    */
    public function removeNode(Tree_Node $node, bool $search = false): bool
    {
        foreach ($this->nodes as $i => $currentNode) {
            if ($currentNode->getUID() == $node->getUID()) {
                // Unset parent, tree and uid values
                unset($node->uid);
                unset($node->parent);
                unset($node->tree);
                unset($this->nodes[$i]);
                $this->nodes = array_values($this->nodes);
                return true;
            } elseif ($search && !empty($this->nodes[$i]->nodes)) {
                $searchNodes[] = $i;
            }
        }
        
        if ($search && !empty($searchNodes)) {
            foreach ($searchNodes as $index) {
                if ($this->nodes[$index]->removeNode($node, true)) {
                    return true;
                }
            }
        }

        return false;
    }
    
    /**
    * Returns the index in the nodes array at which
    * the given node resides. Used in the prev/next Sibling
    * methods.
    *
    * @param  Tree_Node $node The node to return the index of
    * @return int|null        The index of the node or null if
    *                         not found.
    */
    public function indexOf(Tree_Node $node): ?int
    {
        foreach ($this->nodes as $i => $currentNode) {
            if ($currentNode->getUID() == $node->getUID()) {
                return $i;
            }
        }
        
        return null;
    }
    
    /**
    * Returns the number of child nodes in this node/tree.
    * Optionally searches the tree and returns the cumulative count.
    *
    * @param  bool    $search Search tree for nodecount too
    * @return int             The number of nodes found
    */
    public function getNodeCount(bool $search = false): int
    {
        if ($search) {
            $count = count($this->nodes);
            foreach ($this->nodes as $node) {
                $count += $node->nodes->getNodeCount(true);
            }
            
            return $count;
        } else {
            return count($this->nodes);
        }
    }
    
    /**
    * Returns a flat list of the node collection. This array will contain
    * copies, and not references to the nodes.
    *
    * @return Tree_Node[] Flat list of the nodes from top to bottom, left to right.
    */
    public function getFlatList(): array
    {
        $return = [];

        foreach ($this->nodes as $node) {
            $return[] = $node;
            
            // Recurse
            if (!empty($node->nodes)) {
                $return = array_merge($return, $node->nodes->getFlatList());
            }
        }
        
        return $return;
    }
    
    /**
    * Traverses the node collection applying a function to each and every node.
    * The function name given (though this can be anything you can supply to 
    * call_user_func(), not just a name) should take a single argument which is the
    * node object (Tree_Node class). You can then access the nodes data by using
    * the getTag() method. The traversal goes from top to bottom, left to right
    * (ie same order as what you get from getFlatList()).
    *
    * @param callable $function The callback function to use
    * @return void
    */
    public function traverse(callable $function): void
    {
        foreach ($this->nodes as $node) {
            call_user_func($function, $node);
            
            // Recurse
            if (!empty($node->nodes)) {
                $node->nodes->traverse($function);
            }
        }
    }
	
	/**
    * Searches the node collection for a node with a tag matching
	* what you supply. This is a simply "tag == your data" comparison, (=== if strict option is applied)
	* and more advanced comparisons can be made using the traverse() method.
	* This function returns null if nothing is found, and a reference to the
	* first found node if a match is made.
	*
	* @param  mixed $data   Data to try to find and match
	* @param  bool  $strict Whether to use === or simply == to compare
	* @return Tree_Node|null Null if no match, a reference to the first found node
	*                        if a match is made.
    */
	public function search($data, bool $strict = false): ?Tree_Node
	{
		static $searchData;
		static $comparisonType;

		if (is_object($data) && strcasecmp(get_class($data), 'Tree_Node') == 0) {
			// Inside traversion
			if (empty($this->searchFoundNode) && ($comparisonType ? ($data->getTag() === $searchData) : ($data->getTag() == $searchData))) {
				$this->searchFoundNode = $data;
			}
			return null;

		} else {
			// Start traversing
			$searchData     = $data;
			$comparisonType = $strict;

			$this->traverse([$this, 'search']);
		}

		if (!empty($this->searchFoundNode)) {
			$node = $this->searchFoundNode;
			$this->searchFoundNode = null;
			return $node;
		}

		return null;
	}
}
?>
