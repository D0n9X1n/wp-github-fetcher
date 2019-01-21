<?php
/*
Plugin Name: WP Github Fetcher
Plugin URI: https://github.com/MikeCoder/wp-github-fetcher
Description: Yet, just another wp plugins for fetching pages from github.
Version: 0.0.2
Author: MikeCoder
Author URI: https://mikecoder.cn
 */
?>

<?php
/*
Copyright © 2016 TangDongxin

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation
the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
?>

<?php
add_action('post_submitbox_misc_actions', 'fetch_from_github_misc_actions');
function fetch_from_github_misc_actions($post) {
?>
<div class="misc-pub-section tabs-panel">
    <script src="<?php echo plugins_url('wp-github-fetcher/js/fetcher.js'); ?>"></script>
    <label style="width:40%" for="wp_github_url_txt">Github URL:</label><br/>
    <Input id="wp_github_url_txt" type="text" class="form-required" style="height:100%; width: 100%" name="wp_github_url"/>
    <a id="wp_github_url_btn" style="text-align:center; width:80%" onclick="fetch_github_url('<?php echo plugins_url('wp-github-fetcher/api/api.php'); ?>')" class="button button-primary" value="Sync" name="sync"/>Sync</a>
</div>
<?php
}
?>
