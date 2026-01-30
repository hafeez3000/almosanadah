<?php
$self_url = $_SERVER['PHP_SELF'];
$active_menu = "";
$active_menu_expand = "false";
$hide_menu = "hidden";
$is_disabled = "";

if ($self_url == "/umrah/bookingsbyod.php") {
    $active_menu = "active";
    $active_menu_expand = "true";
    $hide_menu = "";
    $is_disabled = "disabled";
}

function isActiveMenuItem($url) {
    global $self_url;
    return strcmp($self_url, $url) !==0 ? "" : "disabled";
}

function isSelectedMenuItem($url) {
    global $self_url;
    return strcmp($self_url, $url) !==0 ? "" : "selected";
}




?>

<!-- Start of Menu Container -->
<div class="p-2">
    <!-- Tree Root -->
    <div class="hs-accordion-treeview-root" role="tree" aria-orientation="vertical">
        <!-- 1st Level Accordion Group -->
        <div class="hs-accordion-group" role="group">
            <!-- 1st Level Accordion Bookings-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false" id="hs--tree-heading-bookings">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false" aria-controls="hs--tree-collapse-bookings">
                        <svg class="size-4 text-gray-800 dark:text-neutral-200" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path class="hs-accordion-active:hidden block" d="M12 5v14"></path>
                        </svg>
                    </button>

                    <div
                        class="grow hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-1.5 rounded-md cursor-pointer">
                        <div class="flex items-center gap-x-3">
                            <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z">
                                </path>
                            </svg>
                            <div class="grow">
                                <span class="text-sm text-gray-800 dark:text-neutral-200">
                                    User Management
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs--tree-collapse-bookings"
                    class="hs-accordion-content <?php  if(isActiveMenuItem('/umrah/bookingchart.php') || isActiveMenuItem('/management/mhome.php')) { echo ''; } else { echo 'hidden'; } ;?> w-full overflow-hidden transition-[height] duration-300" role="group"
                    aria-labelledby="hs--tree-heading-bookings">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem('management/mhome.php');?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem('management/mhome.php'); ?>:opacity-2 <?php echo isActiveMenuItem('/management/mhome.php');?> " data-hs-tree-view-item='{ "value": "Create New Booking1", "isDir": false}' >
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="mhome.php">Find User</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                          <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem('/management/createnewuser.php');?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem('/management/createnewuser.php'); ?>:opacity-2 <?php echo isActiveMenuItem('/management/createnewuser.php');?> " data-hs-tree-view-item='{ "value": "Create New Booking1", "isDir": false}' >
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="createnewuser.php">Create New User</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                    </div>
                    <!-- End 1st Level Accordion Details Master-->
                </div>
        <!-- End 1st Level Accordion Group -->
    </div>
    <!-- End Tree Root -->
</div>
<!-- End of Menu Container -->