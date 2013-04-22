<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>VitaminME</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="description" content="VitaminME is an Android app that allows you to search for food recipes based on your specific nutritional needs">
    <meta name="author" content="VitaminME">

    <link href="<?= base_url('favicon.ico') ?>" rel="shortcut icon" type="image/x-icon" />
    <link href="<?= base_url('favicon.ico') ?>" rel="icon" type="image/x-icon" />
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/img/logo_96.png') ?>" />

    <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">    
    <link href="<?= base_url('assets/css/960_24_col.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.lightbox-0.5.css') ?>" />
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }
    </style>
    <script>
      (function(a,e,f,g,b,c,d){a.GoogleAnalyticsObject=b;a[b]=a[b]||function(){(a[b].q=a[b].q||[]).push(arguments)};a[b].l=1*new Date;c=e.createElement(f);d=e.getElementsByTagName(f)[0];c.async=1;c.src=g;d.parentNode.insertBefore(c,d)})(window,document,"script","//www.google-analytics.com/analytics.js","ga");ga("create","UA-39965482-1","notimplementedexception.me");ga("send","pageview");
    </script>
  <body>
    <div class="block">
      <div id="header-box" class="hero-unit">
        <img src="<?= base_url('assets/img/logo_96.png') ?>" title="VitaminME" alt="VitaminME logo" class="vitaminme-logo"/>
        <h1 class="header-title">VitaminME</h1>      
        <p></p>
        <p>
          VitaminME is an Android app that allows you to search for food recipes based on your specific nutritional needs.
        </p>      
      </div>
      <div id="screenshots">
        <div class="headings">Screenshots</div>
        <div class="grid_1"><div class="holder"></div></div>
        <div class="gallery_grid"><!-- GALLERY -->

          <div id="gallery">
            <ul>
              <li>
                <a href="<?= base_url('assets/screenshots/001.png') ?>" data-caption='<b>Homepage:</b><br/> Add nutrients to your recipe using the "+" sign, remove using the "-" sign. Use the search bar at the top to filter by name. Review your selection using "List Selection" and press "Continue" to get a list of food recipes that your your preferences.'>
                  <img src="<?= base_url('assets/screenshots/thumbs/001.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
              <li>
                <a href="<?= base_url('assets/screenshots/002.png') ?>" data-caption='<b>Recipe List:</b><br/> These recipes match nutritional preferences specified in the homepage. Click on a recipe to see cooking instructions and other details.'>
                  <img src="<?= base_url('assets/screenshots/thumbs/002.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
              <li>
                <a href="<?= base_url('assets/screenshots/003.png') ?>" data-caption='<b>Recipe - Recipe details:</b><br/> Gives details about the recipe, including cooking time, course type (appetizer, breakfast, etc.) and ingredients required to make it.'>
                  <img src="<?= base_url('assets/screenshots/thumbs/003.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
              <li>
                <a href="<?= base_url('assets/screenshots/004.png') ?>" data-caption='<b>Recipe - Recipe ingredients:</b><br/> The ingredients details are very specific, including exact measurements and preparation instructions for each'>
                  <img src="<?= base_url('assets/screenshots/thumbs/004.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
              <li>
                <a href="<?= base_url('assets/screenshots/005.png') ?>" data-caption='<b>Recipe - Recipe instructions:</b><br/> A web page that gives instructions on how to make the recipe. This page takes you to the original author of the recipe, in case you want to contact them, or even rate the recipe.'>
                  <img src="<?= base_url('assets/screenshots/thumbs/005.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
              <li>
                <a href="<?= base_url('assets/screenshots/006.png') ?>" data-caption="<b>Recipe - Nutrition Facts:</b><br/> Detailed nutritional facts are provided here. This includes a breakdown of the nutrients, their amounts and % Daily Values provided by the recipe. This looks exactly like the nutrional chart you would find on an off-the-shelf product at a grocers'. Using VitaminME, you can get a detail breakdown of your home-cooked food, just like you would if you ate something off a super mark aisle.">
                  <img src="<?= base_url('assets/screenshots/thumbs/006.png') ?>" width="107" height="107" alt="" />
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="clear"></div>
      </div>

      <div id="description">
        <div class="headings">Description</div>
        <div class="desc-content">
          <p>
            <b>VitaminME</b> is an Android app that allows you to search for food recipes based on your specific nutritional needs. For example, if you want more Vitamin C and Proteins, but less Carbohydrates and Fat, we will give you a list of recipes you can make at home that provides for your needs.
          </p>
          <p>
            In addition, <b>VitaminME</b> gives you a detailed breakdown of the nutrients present in this recipe. This includes their amounts and % Daily Values provided by the recipe for each nutrient. This looks exactly like the nutrional chart you would find on an off-the-shelf product at a grocers'. Using VitaminME, you get the same level of information for your home-cooked food as you would if you picked up something off a super mark aisle.
          </p>
          <p>
            <b>VitaminME</b> was developed by 4 Drexel University students over a course of 48 hours for the <a href="http://www.phillyhealthcodefest.com" target="_blank">Philly Health CodeFest</a> 
          </p>
          <br/>
          <p>
            <b>VitaminME won the following awards at the event:</b>
            <ol>
              <li>2nd prize
              <li>Majority Student Team Innovation
              <li>People's choice
              <li>Best Mobile
              <li>Best User Interface Design
            </ol>
          </p>
          <br/>
          <p>
            <b>Developed by:</b>
            <ul class="developers">
              <li>Anthony Hurst
              <li><a href="http://notimplementedexception.me" target="_blank">Ayush Sobti</a>
              <li>Matthew Coppola
              <li><a href="http://mayankgureja.com" target="_blank">Mayank Gureja</a>
            </ul>
          </p>        
        </div>
        <div class="video">
          <div class="embed">
            <iframe width="260" height="480" src="http://www.youtube.com/embed/6lF9gybq8_I?vq=large" frameborder="0" allowfullscreen></iframe>
          </div>
        </div>
        <div id="news">
          <div class="headings">
            We're On The News!</div>
          <div class="desc-newscontent">
            <table>
              <tr>
                <td>
                <img class="thumb" src="http://www.drexel.edu/alumni/images/logo_triangle.gif"></td>
                <td>
                <a href="http://thetriangle.org/2013/04/19/coders-address-public-health-issues/http://thetriangle.org/2013/04/19/coders-address-public-health-issues" target="_blank">
                [Drexel Triangle] Coders address public health issues</a><br />
                The inaugural Philly Health Codefest was hosted April 5-7 by 
                Drexel University’s College of Information Science and Technology. 
                The programming event aimed to transform data into health care 
                solutions.</td>
              </tr>
            </table>
          </div>
          <div class="desc-newscontent">
            <table>
              <tr>
                <td>
                <img class="thumb" src="http://medcitynews.com/wp-content/uploads/competition.jpeg"></td>
                <td>
                <a href="http://medcitynews.com/2013/04/app-that-identifies-recipes-by-vitamin-content-gaming-dishes-by-taste-and-health-among-codeathon-winners" target="_blank">
                [MedCity News] App that identifies recipes by vitamin content, gaming dishes 
                by taste and health among codeathon winners</a><br />
                Among the winning entries at a recent health codeathon at Drexel 
                University were ones that focused on obesity like a mobile health 
                app that produces recipes based on vitamins users want.</td>
              </tr>
            </table>
          </div>
          <div class="desc-newscontent">
            <table>
              <tr>
                <td>
                <img class="thumb" src="http://technical.ly/philly/wp-content/uploads/sites/2/2013/04/codefest.jpg"></td>
                <td>
                <a href="http://technical.ly/philly/2013/04/10/healthify-me-wins-5k-grand-prize-at-philly-health-codefest" target="_blank">
                [Technical.ly Philly] Healthify.me wins $5K grand prize at Philly Health Codefest</a><br />
                Nine teams participated in the healthcare-focused hackathon 
                hosted by Drexel University’s i-School and Nvigor, said Drexel 
                science writer Kerry Boland, and four of them were made up of 
                students, as Chief Data Officer Mark Headd noted.</td>
              </tr>
            </table>
          </div>
          <div class="desc-newscontent">
            <table>
              <tr>
                <td>
                <img class="thumb" src="http://www.cis.drexel.edu/faculty/thu/DrexelLogo.jpg"></td>
                <td>
                <a href="http://www.ischool.drexel.edu/home/about/press/article/?articleid=1792" target="_blank">
                [Drexel iSchool] Nutrition Apps Earn Top Prizes at Inaugural Philly Health Codefest 
                at Drexel University</a><br />
                Last weekend, Drexel University’s The iSchool, College of Information 
                Science and Technology hosted its premier Philly Health Codefest, 
                a two-day coding competition to transform data into real-world 
                health care solutions. Nine teams of software developers and 
                designers, health care professionals, educators, students and 
                entrepreneurs attended the event, which took place in the Bossone 
                Research Enterprise Center’s Mitchell Auditorium on April 5-7.</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="headings" style="margin-top: 30px; margin-bottom: 5px;">
          Coming Soon... 
        </div>
        <div class="framed">
          <img src="<?= base_url('assets/screenshots/framed/000.png') ?>" />        
          <img src="<?= base_url('assets/screenshots/framed/001.png') ?>" />        
          <img src="<?= base_url('assets/screenshots/framed/002.png') ?>" />
        </div>
        <p id="play-store">
          <span id="coming-soon">
            Coming soon... <br />
          </span>
          <img alt="Get it on Google Play" src="https://developer.android.com/images/brand/en_generic_rgb_wo_60.png" />          
        </p>
      </div>
      <div class="footer">
        <div class="headings" style="margin-bottom:5px;"></div>        
        <div class="inline">VitaminME, 2013</div>
        <div class="logo-attribute inline">
          <img src="<?= base_url('assets/img/logo_tiny.png') ?>" id="footer-logo" />
          Logo designed by <a href="http://narainkanv.com" target="_blank">Kanv Narain</a></div>
        <div class="clear"></div>
      </div>
    </div>
    <!-- javascript -->
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="<?= base_url('assets/js/jquery.lightbox-0.5.js') ?>"></script>

    <script>
      $(document).ready(function() {
        $('#gallery a').lightBox();
      });
    </script>
  </body>
</html>
