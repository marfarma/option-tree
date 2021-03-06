<?php if (!defined('OT_VERSION')) exit('No direct script access allowed'); ?>

<div id="framework_wrap" class="wrap">

	<div id="header">
    <h1>OptionTree</h1>
    <span class="icon">&nbsp;</span>
    <div class="version">
      <?php echo OT_VERSION; ?>
    </div>
	</div>
  
  <div id="content_wrap">
  
    <div class="info top-info"></div>

    <div id="content">
      <div id="options_tabs" class="docs">
      
        <ul class="options_tabs">
          <li><a href="#general">Usage &amp; Examples</a><span></span></li>
          <li><a href="#option_types">Option Types</a><span></span></li>
          <li><a href="#settings">Creating Options</a><span></span></li>
        </ul>
        
        <div id="general" class="block">
          <h2>Usage &amp; Examples</h2>
          <h3>Function Reference/get_option_tree</h3>
          
          <h3>Description</h3>
          <p>Displays or returns a value from the 'option_tree' array.</p>
          
          <h3>Usage</h3>
          <p><code>&lt;?php get_option_tree( $item_id, $options, $echo, $is_array, $offset ); ?&gt;</code></p>
          
          <h3>Default Usage</h3>
          <pre><code>get_option_tree( 
  'item_id'   => '',
  'options'   => '',
  'echo'      => 'false',
  'is_array'  => 'false',
  'offset'    => -1,
);</code></pre>
          
          <h3>Parameters</h3>
          <p>
            <code><strong>$item_id</strong></code> 
            <br />&nbsp;&nbsp;(<em>string</em>) (<em>required</em>) Enter a unique Option Key to get a returned value or array.
            <br />&nbsp;&nbsp;&nbsp;&nbsp;Default: <em>None</em>
          </p>
          <p>
            <code><strong>$options</strong></code> 
            <br />&nbsp;&nbsp;(<em>array</em>) (<em>optional</em>) Used to cut down on database queries in template files.
            <br />&nbsp;&nbsp;&nbsp;&nbsp;Default: <em>None</em>
          </p>
          <p>
            <code><strong>$echo</strong></code>
            <br />&nbsp;&nbsp;(<em>boolean</em>) (<em>optional</em>) Echo the output. 
            <br />&nbsp;&nbsp;&nbsp;&nbsp;Default: FALSE
          </p>
          <p>
            <code><strong>$is_array</strong></code> 
            <br />&nbsp;&nbsp;(<em>boolean</em>) (<em>optional</em>) Used to indicate the $item_id is an array of values.
            <br />&nbsp;&nbsp;&nbsp;&nbsp;Default: FALSE
          </p>
          <p>
            <code><strong>$offset</strong></code> 
            <br />&nbsp;&nbsp;(<em>integer</em>) (<em>optional</em>) Numeric offset key for the $item_id array, -1 will return all values (an array starts at 0).
            <br />&nbsp;&nbsp;&nbsp;&nbsp;Default: -1
          </p>

          
          <h3>Examples</h3>
          <p>
            This example assigns the value of the <code>get_option('option_tree')</code> array to the variable <code>$theme_options</code> for use in PHP. You would then add this code to the top of your header.php file and use that variable as the <code>$options</code> variable in the <code>get_option_tree()</code> function. This helps to reduce database queries anytime you want to request multiple theme options in a template files. This is optional, but may help speed up things up.
            <pre><code>&lt?php $theme_options = get_option('option_tree'); ?&gt;</code></pre>
          </p>
          
          <p>
            This example returns the $item_id value.
            <pre><code>&lt?php 
if ( function_exists( 'get_option_tree' ) ) {
  get_option_tree( 'test_option' );
}
?&gt;</code></pre>
          </p>
          
          <p>
            These examples will echo the $item_id value.
            <pre><code>&lt?php 
if ( function_exists( 'get_option_tree') ) {
  get_option_tree( 'test_option', '', true );
}
?&gt;

&lt?php 
if ( function_exists( 'get_option_tree') ) {
  echo get_option_tree( 'test_option' );
}
?&gt;</code></pre>
          </p>
          
          <p>
            This example will echo the value of $item_id by grabbing the first offset key in the array. At the moment, this will only work if the item_type is a checkbox.
            <pre><code>&lt?php 
if ( function_exists( 'get_option_tree' ) ) {
  get_option_tree( 'test_option', '', true, true, 0 );
}
?&gt;</code></pre>
          </p>

          <p>
            This example assigns the value of $item_id to the variable $ids for use in PHP. As well, it uses the <code>$theme_options</code> variable I set in the first example above in my header.php file to reduce database queries. It then loops through all the array items and echos an unordered list of page links (navigation). 
            <pre><code>&lt?php
if ( function_exists( 'get_option_tree' ) ) {
  // set an array of page id's
  $ids = get_option_tree( 'list_of_page_ids', $theme_options, false, true, -1 );

  // loop through id's & echo custom navigation
  echo '&lt;ul&gt;';
  foreach( $ids as $id ) {
    echo '&lt;li&gt;&lt;a href="'.get_permalink($id).'"&gt;'.get_the_title($id).'&lt;/a&gt;&lt;/li&gt;';
  }
  echo '&lt;/ul&gt;';
}
?&gt;</code></pre>
            OR a more WordPress version would be:<br /><br />
            <pre><code>&lt?php
if ( function_exists( 'get_option_tree' ) ) {
  // set an array of page id's
  $ids = get_option_tree( 'list_of_page_ids', $theme_options, false, true, -1 );

  // echo custom navigation using wp_list_pages()
  echo '&lt;ul&gt;';
  wp_list_pages(
    array(
      'include' => $ids,
      'title_li' => ''
    )
  );
  echo '&lt;/ul&gt;';
}
?&gt;</code></pre>
          </p>

        </div>
        
        <div id="option_types" class="block">
          <h2>Option Types</h2>
          <h3>Overview of available Option Types.</h3>
          
          <p>
            <strong>Heading</strong>:<br />
            Used only in the WordPress Admin area to logical separate Theme Options into sections for easy editing. A Heading will create a navigation menu item on the <a href="<?php echo admin_url().'admin.php?page=option_tree'; ?>"><strong>Theme Options</strong></a> page. You would NEVER use this in your themes template files.
          </p>
          
          <p>
            <strong>Textblock</strong>:<br />
            Used only in the WordPress Admin area. A Textblock will allow you to create &amp; display HTML on your <a href="<?php echo admin_url().'admin.php?page=option_tree'; ?>"><strong>Theme Options</strong></a> page. You can then use the Textblock to add a more detailed set of instruction on how the options are used in your theme. You would NEVER use this in your themes template files.
          </p>
          
          <p>
            <strong>Input</strong>:<br />
            The Input option type would be used to save a simple string value. Maybe a link to feedburner, your Twitter username, or Google Analytics ID. Any optional or required text that is of reasonably short character length.
          </p>
          
          <p>
            <strong>Checkbox</strong>:<br />
            A Checkbox option type could ask a question. For example, "Do you want to activate asynchronous Google analytics?" would be a simple one checkbox question. You could have more complex usages but the idea is that you can easily grab the value of the checkbox and use it in you theme. In this situation you would test if the checkbox has a value and execute a block of code if it does and do nothing if it doesn't.
          </p>
          
          <p>
            <strong>Radio</strong>:<br />
            A Radio option type could ask a question. For example, "Do you want to activate the custom navigation?" could require a yes or no answer with a radio option. In this situation you would test if the radio has a value of 'yes' and execute a block of code, or if it's 'no' execute a different block of code. Since a radio has to be one or the other nothing will execute if you have not saved the options yet.
          </p>
          
          <p>
            <strong>Select</strong>:<br />
            Could use the Select option type to list different theme styles or choose any other setting that would be chosen from a select option list.
          </p>
          
          <p>
            <strong>Textarea</strong>:<br />
            With the Textarea option type users can add custom code or text for use in the theme.
          </p>
          
          <p>
            <strong>Upload</strong>:<br />
            The Upload option type is used to upload any WordPress supported media. After uploading, users are required to press the "<strong style="color:red;">Insert into Post</strong>" button in order to populate the input with the URI of that media. There is one caveat of this feature. If you import the theme options and have uploaded media on one site the old URI will not reflect the URI of your new site. You'll have to re-upload or FTP any media to your new server and change the URIs if necessary.
          </p>
          
          <p>
            <strong>Colorpicker</strong>:<br />
            A Colorpicker is a very self explanatory feature that saves hex HTML color codes. Use it to set/change the color of something in your theme.
          </p>
          
          <p>
            <strong>Post</strong>:<br />
            The Post option type is an option select list of post IDs. It will return a single post ID for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Posts</strong>:<br />
            The Posts option type is a checkbox list of post IDs. It will return an array of multiple post IDs for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Page</strong>:<br />
            The Page option type is an option select list of page IDs. It will return a single page ID for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Pages</strong>:<br />
            The Pages option type is a checkbox list of page IDs. It will return an array of multiple page IDs for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Category</strong>:<br />
            The Category type is an option select list of category IDs. It will return a single category ID for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Categories</strong>:<br />
            The Categories option type is a checkbox list of category IDs. It will return an array of multiple category IDs for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Tag</strong>:<br />
            The Tag option type is an option select list of tag IDs. It will return a single tag ID for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Tags</strong>:<br />
            The Tags option type is a checkbox list of tag IDs. It will return an array of multiple tag IDs for use in a custom function or loop.
          </p>
          
          <p>
            <strong>Custom Post</strong>:<br />
            The Custom Post option type is an option select list of IDs from any available wordpress post type or custom post type. It will return a single ID for use in a custom function or loop. Custom Post requires the post_type you are querying when created.
          </p>
          
          <p>
            <strong>Custom Posts</strong>:<br />
            The Custom Posts option type is a checkbox list of IDs from any available wordpress post type or custom post type. It will return an array of multiple IDs for use in a custom function or loop. Custom Posts requires the post_type you are querying when created.
          </p>
                                     
        </div>
        
        <div id="settings" class="block">
          <h2>Creating Options</h2>
          <h3>Overview of available Theme Option fields.</h3>
          
          <p>
            <strong>Title</strong>:<br />
            The Title field should be a short but descriptive block of text 100 characters or less with no HTML.
          </p>
          
          <p>
            <strong>Option Key</strong>:<br />
            The Option Key field is a unique alphanumeric key used to differentiate each theme option (underscores are acceptable). Also, the plugin will lowercase any text you write in this field and bridge all spaces with an underscore automatically.
          </p>
          
          <p style="padding-bottom:5px">
            <strong>Option Type</strong>:<br />
            You are required to choose one of the supported option types. They are:
          </p>
          <ul class="doc_list">
            <li>Heading</li>
            <li>Textblock</li>
            <li>Input</li>
            <li>Checkbox</li>
            <li>Radio</li>
            <li>Select</li>
            <li>Textarea</li>
            <li>Upload</li>
            <li>Colorpicker</li>
            <li>Post</li>
            <li>Posts</li>
            <li>Page</li>
            <li>Pages</li>
            <li>Category</li>
            <li>Categories</li>
            <li>Tag</li>
            <li>Tags</li>
            <li>Custom Post</li>
            <li>Custom Posts</li>
          </ul>
          
          <p>
            <strong>Description</strong>:<br />
            Enter a detailed description of the option for end users to read. However, if the option type is a Textblock, enter the text you want to display (HTML is allowed).
          </p>

          <p>
            <strong>Options</strong>:<br />
            Enter a comma separated list of options in this field. For example, you could have "One,Two,Three" or just a single value like "Yes" for a checkbox.
          </p>
          
          <p>
            <strong>Row Count</strong>:<br />
            Enter a numeric value for the number of rows in your textarea.
          </p>
          
          <p style="padding-bottom:5px">
            <strong>Post Type</strong>:<br />
            Enter your custom post_type. These are the default post types available with WordPress. You can also add your own custom post_type.
          </p>
          <ul class="doc_list">
            <li>post</li>
            <li>page</li>
            <li>attachment</li>
            <li>any</li>
          </ul>
          
        </div>
        
        <br class="clear" />
      </div>
    </div>
    <div class="info bottom"></div>   
  </div>

</div>
<!-- [END] framework_wrap -->