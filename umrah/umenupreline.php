<?php
$self_url = $_SERVER["PHP_SELF"];
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

function isActiveMenuItem($url)
{
    global $self_url;
    return strcmp($self_url, $url) !== 0 ? "" : "disabled";
}

function isSelectedMenuItem($url)
{
    global $self_url;
    return strcmp($self_url, $url) !== 0 ? "" : "selected";
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
                                    Bookings
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs--tree-collapse-bookings"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/bookingchart.php") ||
                        isActiveMenuItem("/umrah/newbookings.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300" role="group"
                    aria-labelledby="hs--tree-heading-bookings">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/newbookings.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/newbookings.php",
                                ); ?>:opacity-2 <?php echo isActiveMenuItem(
    "/umrah/newbookings.php",
); ?> " data-hs-tree-view-item='{ "value": "Create New Booking1", "isDir": false}' >
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="newbookings.php">Create New Booking</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100  dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/bookingchart.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3 ">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/bookingchart.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/bookingchart.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1   dark:text-neutral-200">
                                        <a class="no-underline" href="bookingchart.php">Booking Cart</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Bookings-->
            <!-- 1st Level Accordion Booking Details-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-bookings-detailstree-heading-bookings-details">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false" aria-controls="hs-bookings-detailstree-collapse-bookings-details">
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
                                    Bookings Details
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                         <div id="hs-bookings-detailstree-collapse-bookings-details"

                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/bookingsbyod.php") ||
                        isActiveMenuItem("/umrah/bookingsbycrd.php") ||
                        isActiveMenuItem("/umrah/bookingsbyamendment.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300"

                    role="group" aria-labelledby="hs-bookings-detailstree-heading-bookings-details">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/bookingsbyod.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                  <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                      "/umrah/bookingsbyod.php",
                                  ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/bookingsbyod.php",
); ?>" data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="bookingsbyod.php">By Order Date</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/bookingsbycrd.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/bookingsbycrd.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/bookingsbycrd.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="bookingsbycrd.php">By Check In</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/bookingsbyamendment.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class=" hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/bookingsbyamendment.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/bookingsbyamendment.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="bookingsbyamendment.php">By Amend Date</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Booking Details-->
            <!-- 1st Level Accordion Hotel Reports-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-hotel-reportstree-heading-hotel-reports">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false" aria-controls="hs-hotel-reportstree-collapse-hotel-reports">
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
                                    Hotel Reports
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs-hotel-reportstree-collapse-hotel-reports"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/hotsummary.php") ||
                        isActiveMenuItem("/umrah/roominglistsbyhotel.php") ||
                        isActiveMenuItem("/umrah/gueststatus.php") ||
                        isActiveMenuItem("/umrah/salesreportbyh.php") ||
                        isActiveMenuItem("/umrah/salesreportbyhd.php") ||
                        isActiveMenuItem("/umrah/salesreportbya.php") ||
                        isActiveMenuItem("/umrah/salesreportbyc.php") ||
                        isActiveMenuItem("/umrah/salesreportbyuser.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300"
                    role="group" aria-labelledby="hs-hotel-reportstree-heading-hotel-reports">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/hotsummary.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/hotsummary.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/hotsummary.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="hotsummary.php">Hotel Summary</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/roominglistsbyhotel.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/roominglistsbyhotel.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/roominglistsbyhotel.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="roominglistsbyhotel.php">Rooming Lists</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/gueststatus.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/gueststatus.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/gueststatus.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="gueststatus.php">Guest Status</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbyh.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbyh.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyh.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbyh.php">Sales by Hotel</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbyhd.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbyhd.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyhd.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbyhd.php">Sales by Date</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbya.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbya.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbya.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbya.php">Sales by Agent</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbyc.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbyc.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyc.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbyc.php">Sales by Country</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbyuser.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbyuser.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyuser.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbyuser.php">Sales by User</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Hotel Reports-->
            <!-- 1st Level Accordion Transportation Reports-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-transportation-reportstree-heading-transportation-reports">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false"
                        aria-controls="hs-transportation-reportstree-collapse-transportation-reports">
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
                                    Transportation Reports
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs-transportation-reportstree-collapse-transportation-reports"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/salesreportbytc.php") ||
                        isActiveMenuItem("/umrah/salesreportbyt.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300"
                    role="group" aria-labelledby="hs-transportation-reportstree-heading-transportation-reports">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">

                            <!-- 1st Level Item -->
                            <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                                "/umrah/salesreportbyt.php",
                            ); ?>"
                                role="treeitem">
                                <div class="flex items-center gap-x-3">
                                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">

                                        <path d="m9 18 6-6-6-6"></path>

                                    </svg>
                                    <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                        "/umrah/salesreportbyt.php",
                                    ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyt.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                        <span
                                            class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                            <a class="no-underline" href="salesreportbyt.php">Sales</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbytc.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbytc.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbytc.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbytc.php">Sales by Country</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Transportation Reports-->
            <!-- 1st Level Accordion Visa & Other Reports-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-visa-and-other-reportstree-heading-visa-and-other-reports">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false"
                        aria-controls="hs-visa-and-other-reportstree-collapse-visa-and-other-reports">
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
                                    Visa & Other Reports
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs-visa-and-other-reportstree-collapse-visa-and-other-reports"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/salesreportbyvc.php") ||
                        isActiveMenuItem("/umrah/salesreportbyv.php") ||
                        isActiveMenuItem("/umrah/totalsalesreportbycountry.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300"
                    role="group" aria-labelledby="hs-visa-and-other-reportstree-heading-visa-and-other-reports">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">

                            <!-- 1st Level Item -->
                            <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                                "/umrah/salesreportbyv.php",
                            ); ?>"
                                role="treeitem">
                                <div class="flex items-center gap-x-3">
                                    <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round">

                                        <path d="m9 18 6-6-6-6"></path>

                                    </svg>
                                    <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                        "/umrah/salesreportbyv.php",
                                    ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyv.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                        <span
                                            class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                            <a class="no-underline" href="salesreportbyv.php">Visa Sales</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/salesreportbyvc.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/salesreportbyvc.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/salesreportbyvc.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="salesreportbyvc.php">Visa Sales By Country</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/totalsalesreportbycountry.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/totalsalesreportbycountry.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/totalsalesreportbycountry.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="totalsalesreportbycountry.php">Total Sales By Country</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Visa & Other Reports-->
            <!-- 1st Level Accordion Price & Allotment Master-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-price-allotment-mastertree-heading-price-allotment-master">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false"
                        aria-controls="hs-price-allotment-mastertree-collapse-price-allotment-master">
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
                                    Price & Allotment Master
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs-price-allotment-mastertree-collapse-price-allotment-master"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/resratesentry.php") ||
                        isActiveMenuItem("/umrah/restransrates.php") ||
                        isActiveMenuItem("/umrah/allotmentsetup.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?> w-full overflow-hidden transition-[height] duration-300"
                    role="group" aria-labelledby="hs-price-allotment-mastertree-heading-price-allotment-master">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">

                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/resratesentry.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/resratesentry.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/resratesentry.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="resratesentry.php">Hotel Price</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/restransrates.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/restransrates.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/restransrates.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="restransrates.php">Transportation Price</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/allotmentsetup.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/allotmentsetup.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/allotmentsetup.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="allotmentsetup.php">Hotel Allotments</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Price & Allotment Master-->
            <!-- 1st Level Accordion Details Master-->
            <div class="hs-accordion" role="treeitem" aria-expanded="false"
                id="hs-detials-mastertree-heading-detials-master">
                <!-- 1st Level Accordion Heading -->
                <div class="hs-accordion-heading py-0.5 flex items-center gap-x-0.5 w-full">
                    <button
                        class="hs-accordion-toggle border-none size-6 flex justify-center items-center hover:bg-gray-100 rounded-md focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-expanded="false" aria-controls="hs-detials-mastertree-collapse-detials-master">
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
                                    Details Master
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End 1st Level Accordion Heading -->

                <!-- 1st Level Collapse -->
                <div id="hs-detials-mastertree-collapse-detials-master"
                    class="hs-accordion-content <?php if (
                        isActiveMenuItem("/umrah/hoteldetails.php") ||
                        isActiveMenuItem("/umrah/suppdetails.php") ||
                        isActiveMenuItem("/umrah/transdetails.php") ||
                        isActiveMenuItem("/umrah/agentdetails.php")
                    ) {
                        echo "";
                    } else {
                        echo "hidden";
                    } ?>  w-full overflow-hidden transition-[height] duration-300"
                    role="group" aria-labelledby="hs-detials-mastertree-heading-detials-master">
                    <div
                        class="ms-3 ps-3 relative before:absolute before:top-0 before:start-0 before:w-0.5 before:-ms-px before:h-full before:bg-gray-100 dark:before:bg-neutral-700">

                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/hoteldetails.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/hoteldetails.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/hoteldetails.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="hoteldetails.php">Hotel Master</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/suppdetails.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/suppdetails.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/suppdetails.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="suppdetails.php">Supplier Master</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->
                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/transdetails.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/transdetails.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/transdetails.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="transdetails.php">Transportation Master</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                        <!-- 1st Level Item -->
                        <div class="hs-accordion-selectable hs-accordion-selected:bg-gray-100 dark:hs-accordion-selected:bg-neutral-700 px-2 rounded-md cursor-pointer mb-2 <?php echo isSelectedMenuItem(
                            "/umrah/agentdetails.php",
                        ); ?>"
                            role="treeitem">
                            <div class="flex items-center gap-x-3">
                                <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round">

                                    <path d="m9 18 6-6-6-6"></path>

                                </svg>
                                <div class="hs-tree-view-selected:bg-gray-100 dark:hs-tree-view-selected:bg-neutral-700 hs-tree-view-<?php echo isActiveMenuItem(
                                    "/umrah/agentdetails.php",
                                ); ?>:opacity-50 <?php echo isActiveMenuItem(
    "/umrah/agentdetails.php",
); ?> " data-hs-tree-view-item='{"isDir": false}'>
                                    <span
                                        class="text-sm text-gray-800   hover:bg-gray-200 rounded-sm p-1  dark:text-neutral-200">
                                        <a class="no-underline" href="agentdetails.php">Customer Master</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- End 1st Level Item -->

                    </div>
                </div>
                <!-- End 1st Level Collapse -->
            </div>
            <!-- End 1st Level Accordion Details Master-->
        </div>
        <!-- End 1st Level Accordion Group -->
    </div>
    <!-- End Tree Root -->
</div>
<!-- End of Menu Container -->
