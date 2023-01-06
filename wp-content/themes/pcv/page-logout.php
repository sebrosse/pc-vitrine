<?php

/**
 * Template name: Logout
 */

wp_logout();

wp_redirect( pcv_get_page_link( \App\ACFSetup::OPTION_PAGE_LOGIN ) );