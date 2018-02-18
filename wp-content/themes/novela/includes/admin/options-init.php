<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('admin_folder_Redux_Framework_config')) {

    class admin_folder_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'novela'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'novela'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'novela'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'novela'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'novela'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'novela'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'novela'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'novela') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'novela') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'novela'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title' => __('General', 'novela'),
                'desc' =>'',
                'icon' => 'el-icon-cogs',
                'fields' => array(

                    array(
                        'id' => 'custom-logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Custom Logo', 'novela'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.,
                        'readonly' => false,
                        'subtitle' => __('Upload the custom logo of your site, or enter the URL address of the image. If there is no logo uploaded, the title of the site will appear as a text.', 'novela'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'custom-favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Custom Favicon', 'novela'),
                        'compiler' => 'true',
                        'readonly' => false,
                        'subtitle' => __('Upload 16x16 or 32x32 PNG or GIF image for favicon.', 'novela'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'sidebar-bg',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Sidebar Background Image', 'novela'),
                        'compiler' => 'true',
                        'readonly' => false,
                        'default' => '',
                    ),
                    array(
                        'id' => 'footer-text',
                        'type' => 'textarea',
                        'title' => __('Footer text', 'novela' ),
                        'validate' => 'html', //see http://codex.wordpress.org/Function_Reference/wp_kses_post
                        'default' => '&copy; Yoursite'
                    ),
                    array(
                        'id' => 'tracking-code',
                        'type' => 'textarea',
                        'title' => __('Tracking Code', 'novela'),
                        'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'novela')
                    ),
                    array(
                        'id' => 'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'novela'),
                        'mode' => 'css',
                        'subtitle' => __('Paste your custom CSS here.', 'novela')
                    )
                ),
            );

            $this->sections[] = array(
                'title' => __('Typography', 'novela'),
                'desc' =>'',
                'icon' => 'el-icon-text-height',
                'fields' => array(

                    array(
                        'id'          => 'header-font',
                        'type'        => 'typography',
                        'title'       => __('Headers and Titles Font', 'novela'),
                        'google'      => true,
                        'color'       => false,
                        'font-size'   => false,
                        'line-height' => false,
                        'text-align'  => false,
                        'font-backup' => true,
                        'output'      => array('h1', 'h2', 'h3', 'h4', 'h5', 'h6', '.h1', '.h2', '.h3', '.h4', '.h5', '.h6','.book-information-inner > p:first-of-type:first-letter', '.character-infobox > p:first-of-type:first-letter', '.author-bio > p:first-of-type:first-letter', '.post-content > p:first-of-type:first-letter', '.story-quote','.character-name', '.author-subtitle' ),
                        'units'       =>'px',
                        'default'     => array(
                            'font-weight'  => '400',
                            'font-family' => 'Ovo',
                            'google'      => true
                            ),
                        ),
                    array(
                        'id'          => 'body-font',
                        'type'        => 'typography',
                        'title'       => __('Body Font', 'novela'),
                        'google'      => true,
                        'color'       => false,
                        'font-size'   => true,
                        'line-height' => false,
                        'text-align'  => false,
                        'font-backup' => true,
                        'all_styles'  => true,
                        'output'      => array( 'body'),
                        'units'       =>'px',
                        'default'     => array(
                            'font-weight'  => '300',
                            'font-family' => 'Source Sans Pro',
                            'google'      => true,
                            'font-size' => 18
                            ),
                        )

                    )
                );

            $this->sections[] = array(
                'title' => __('Social', 'novela'),
                'desc' => __('Insert the URLs of the networks that you want to be shown.', 'novela'),
                'icon' => 'el-icon-user',
                'fields' => array(

                    array(
                        'id'          => 'facebook',
                        'type'        => 'text',
                        'title'       => __('Facebook', 'novela')
                        ),
                    array(
                        'id'          => 'twitter',
                        'type'        => 'text',
                        'title'       => __('Twitter', 'novela')
                        ),
                    array(
                        'id'          => 'dribbble',
                        'type'        => 'text',
                        'title'       => __('Dribbble', 'novela')
                        ),
                    array(
                        'id'          => 'pinterest',
                        'type'        => 'text',
                        'title'       => __('Pinterest', 'novela')
                        ),
                    array(
                        'id'          => 'instagram',
                        'type'        => 'text',
                        'title'       => __('Instagram', 'novela')
                        ),
                    array(
                        'id'          => 'deviantart',
                        'type'        => 'text',
                        'title'       => __('DeviantArt', 'novela')
                        ),
                    array(
                        'id'          => 'google',
                        'type'        => 'text',
                        'title'       => __('Google', 'novela')
                        ),
                    array(
                        'id'          => 'linkedin',
                        'type'        => 'text',
                        'title'       => __('Linkedin', 'novela')
                        ),
                    array(
                        'id'          => 'flickr',
                        'type'        => 'text',
                        'title'       => __('Flickr', 'novela')
                        ),
                    array(
                        'id'          => 'youtube',
                        'type'        => 'text',
                        'title'       => __('YouTube', 'novela')
                        ),

                    )
                );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'novela'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'novela')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'novela'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'novela')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'novela');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'novela_data',
                'display_name' => 'Novela Options',
                'page_slug' => '_options',
                'page_title' => 'Novela Options',
                'update_notice' => true,
                'intro_text' => '<p>This is the Novela Options panel. You can change options for the theme from here.</p>',
                'admin_bar' => true,
                'menu_type' => 'menu',
                'menu_title' => 'Novela Options',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'customizer' => true,
                'dev_mode' => false,
                'default_mark' => '*',
                'google_api_key' => 'AIzaSyDN9ZwsPOMFEKRPQRZn-PZ2QKyMZCetkB4',
                'google_update_weekly' => true,
                'hints' =>
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_size' => 'normal',
                  'tip_style' =>
                  array(
                    'color' => 'light',
                  ),
                  'tip_position' =>
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' =>
                  array(
                    'show' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseover',
                    ),
                    'hide' =>
                    array(
                      'duration' => '500',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => true,
                'output_tag' => true,
                'compiler' => true,
                'page_icon' => 'icon-themes',
                'page_permissions' => 'manage_options',
                'save_defaults' => true,
                'show_import_export' => true,
                'transient_time' => '3600',
                'network_sites' => true,
              );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

        }

    }

    global $reduxConfig;
    $reduxConfig = new admin_folder_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('admin_folder_my_custom_field')):
    function admin_folder_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('admin_folder_validate_callback_function')):
    function admin_folder_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
