<?php
/**
 * Development Page - Refactor this.
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
$smarty->assign('page_title', 'Poetic Web Development, Since 1999 :: ChristopherL');
$smarty->assign('page_desc', 'Codetry® lives at the intersection of art and technology. At ChristopherL we call that intersection home, and have done so for nearly two decades.');
$smarty->assign('page_url', '/development');
$smarty->assign('active_nav', 'development');


// Social Images
$smarty->assign('image_facebook', '/img/social/development.jpg');
$smarty->assign('image_twitter', '/img/social/development.jpg');


// Optional Extras
$smarty->assign('head_extras', '');
$smarty->assign('body_header_extras', '');
$smarty->assign('body_footer_extras', '');

$footer_cta = newsletter_subscribe();

// Page Content
$content = <<<HTML
    <section class="image-right">
        <div class="the-outer-limits">
            <h1>Working the 1s and 0s</h1>
            <img src="img/at-desk.jpg"
                alt="A Person Sitting at a Desk"
                title="Poet At Work"
                width="300">
            <p>
                Long ago, a now ubiquitous <a href="https://wordpress.org/" target="_blank">blogging software</a> project popularized the phrase
                <i>code is poetry</i>. And we believe it should be. Creating software is not dissimilar to creating art. The software development process
                is a journey and the poetry of source code tells the story of that journey, and the people who share it.
            </p>
            <h2>Open Source</h2>
            <p>
                At ChristopherL we want to share our journey with as many people as possible, in our own small way, which is why we release
                our projects as open source.
            </p>
            <p>All of the following are available for you to enjoy for free, <a href="https://en.wikipedia.org/wiki/Gratis_versus_libre" target="_blank">as in beer and speech</a>.</p>
            <ul>
                <li><a href="https://github.com/chrislarrycarl/ChristopherL" target="_blank">ChristopherL</a> &ndash; The code that runs this very website. You're using it right now!</li>
                <li><a href="https://github.com/chrislarrycarl/Helios-Calendar" target="_blank">Helios Calendar</a> &ndash; A once grand web calendar.</li>
                <li><a href="https://github.com/chrislarrycarl/m2" target="_blank">M2</a> &ndash; Quick and easy basic math flash cards.</li>
                <li><a href="https://github.com/chrislarrycarl/cl_session" target="_blank">cl_session</a> &ndash; An easy to use PHP session class.</li>
            </ul>
        </div>
    </section>
    <section class="highlight logos">
        <div class="the-outer-limits container row">
            <div class="two columns">
                <img src="img/logos/php.png" alt="PHP Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/mysql.png" alt="MySQL Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/javascript.png" alt="JavaScript Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/html_css.png" alt="HTML5 and CSS3 Logos" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/apache.png" alt="Apache Logo" height="50">
            </div>
            <div class="two columns">
                <img src="img/logos/others_dev.png" alt="Other Development Tool Logos" height="50">
            </div>
        </div>
    </section>
    
    {$footer_cta}
    
    <span class="lightbox egg" data-featherlight="#fl1" data-event="dev easter egg">:)</span>
    <img src="img/stocking-hat.jpg"
        alt="A Dragon in a Stocking Hat"
        title="It Keeps His Ears Warm While He Codes"
        id="fl1" 
        class="fl" 
        width="500">
HTML;
$smarty->assign('content', smarty_content($content));


// Smoosh it all down, this will make viewing the page source a pain for people
// but will save literally 10 of milliseconds in page download time.
smarty_smoosh();


// Output the page
$smarty->display('base.tpl');