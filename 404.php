<?php
/**
 * 404 Page - Hopefully nobody sees this.
 *
 * @package ChristopherL.com
 * @copyright 2016 ChristopherL (https://github.com/chrislarrycarl)
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */


// Load Site Configuration
require_once('include/config.inc.php');
require_once('include/functions.inc.php');


// Load Smarty Library and Plugin
require_once('include/libs/smarty/Smarty.class.php');


// Instantiate Smarty Class and Initalize Global Config
$smarty = new Smarty();
smarty_scaffolding($smarty, $config);


// Create Meta & Page Settings
$smarty->assign('page_title', 'You must be lost. :: ChristopherL');
$smarty->assign('page_desc', 'I do not even know why we wrote this page description. Nobody should ever even see it...');

// don't set page url for 404 pages, active_nav also controls hero image so that should be set
$smarty->assign('page_url', '');
$smarty->assign('active_nav', '404');


// Social Images
$smarty->assign('image_facebook', '/img/social/404.jpg');
$smarty->assign('image_twitter', '/img/social/404.jpg');


// Optional Extras
$smarty->assign('head_extras', '');
$smarty->assign('body_header_extras', '');
$smarty->assign('body_footer_extras', '');

$footer_cta = newsletter_subscribe();

// Page Content (Use regex to remove newline characters.
$content = <<<HTML
    <section>
        <div class="the-outer-limits">
            <h1><span class="hidden-phone">Uh&hellip;</span>Hello There?</h1>
            <p>
                We have no idea what you think you're doing here, but since you are, please pull up a chair and enjoy a nice plateful of 404.
            </p>
            
            <h2>Fancy a Serenade?</h2>
            <p>
                404 is lovely on it's own, but it's especially nice with a little dinner music.
            </p>
            
            <iframe src="https://www.youtube.com/embed/AKW8pBYrUKk?list=PLzOIUxwoEJHiP2q_Tzd7z1v_iinEjhyMo?showinfo=0&showsearch=0&rel=0&iv_load_policy=3&cc_load_policy=0&hd=1"
                frameborder="0"
                width="560" 
                height="315"
                allowfullscreen
                class="wide-stance"></iframe>
            
            <h2>Food Porn</h2>
            <p>
                Wow, you're still here huh? Well, since you like to scroll why don't you check out this feed of Grade A food porn.
            </p>
            <a class="twitter-timeline wide-stance"  href="https://twitter.com/figandsprout" data-widget-id="724603432938545152"></a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
    </section>
    <section class="highlight">
        <div class="the-outer-limits container row">
            <h3>This is Silly</h3>
            <p>
                You must really like us. If you're not just showing off, <a href="contact" data-event="highlight-ribbon">maybe we should be friends</a>.
            </p>
        </div>
    </section>
    
    {$footer_cta}
HTML;
$smarty->assign('content', smarty_content($content));


// Smoosh it all down, this will make viewing the page source a pain for people
// but will save literally 10 of milliseconds in page download time.
smarty_smoosh();


// Output the page
$smarty->display('base.tpl');