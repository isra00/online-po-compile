<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php print MAIN_TITLE ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Convert your .po files into .mo on-line for free - online msgfmt">
    <meta name="keywords" content="msgfmt, gettext, gnu gettext, convert, online, free, po, mo, po file, mo file, po converter">
    <meta name="author" content="Israel Viana">
    <meta property="og:title" content="<?php print MAIN_TITLE ?>">
    <meta property="og:description" content="Convert your .po files into .mo on-line for free - online msgfmt">
    <meta property="og:url" content="http://online-po-compile.israelviana.es/"/>
    <meta property="og:type" content="website"/>
    <meta property="fb:app_id" content="<?php print FB_APP_ID ?>"/>

    <link href="/assets/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <style>
      h1 { overflow: hidden; }
      h1 span:first-child { float: left; line-height: 1.2em; }
      h1 .tweet-button { float: left; margin: 15px; }
      h1 .fb-like { float: left; margin: 26px 0 0 30px; }
      h1 .tweet { float: left; margin: 0 0 0 20px; }
      h4 { margin-bottom: 2em; }
      .captcha { margin: 1em 0; display: none; }
      .submit { margin-top: 1em; }
      .footer { text-align: center; }
      .download-page { text-align: center; }
      .download { margin-top: 2em; }
      .download .btn { padding: 15px 25px; }
      .explanation h3 { margin-top: 0; }
      .explanation p { font-size: .8em; line-height: 1.6em; }
    </style>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-6329572-2']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </head>
  <body>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) return;
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
     fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <?php if (isset($deliver)) : ?>
    
    <div class="hero-unit download-page">
      <h1>
        <span>Done! Here you have it</span>
        <div class="fb-like" data-href="http://online-po-compile.israelviana.es/?utm_source=Share&amp;utm_medium=FB+Like+after+convert&amp;utm_campaign=Share" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false"></div>
        <span class="tweet">
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://online-po-compile.israelviana.es/?utm_source=Share&amp;utm_medium=Tweet+after+convert&amp;utm_campaign=Share" data-via="ivianag" data-size="large" data-hashtags="i18n">Tweet</a></span>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </span>
      </h1>

      <p class="download"><a onclick="_gaq.push(['_trackEvent', 'Interactions', 'Download', 'file_id', '<?php print FILE_ID ?>'])" data-file-id="<?php print FILE_ID ?>" class="btn btn-large btn-success download-button" href="<?php print $download_url ?>">Download your compiled .mo file</a></p>
    </div>
    
    <?php else : ?>
  
    <div class="hero-unit">
      <h1>
        <span>Compile .po files into .mo</span>
        <div class="fb-like" data-href="http://online-po-compile.israelviana.es/?utm_source=Share&amp;utm_medium=FB+Like+before+convert&amp;utm_campaign=Share" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false"></div>
        <span class="tweet">
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://online-po-compile.israelviana.es/?utm_source=Share&amp;utm_medium=Tweet+after+convert&amp;utm_campaign=Share" data-via="ivianag" data-size="large" data-hashtags="i18n">Tweet</a></span>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </span>
      </h1>

      <h4>Quick, easy and for free</h4>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" class="row">
      
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-error">
          <ul>
            <li><?php print join('</li><li>', $errors) ?></li>
          </ul>
        </div>
        <?php endif ?>
      
        <div class="span6 well">
          <label for="up">Upload your .po file (max. <?php print formatRawSize(MAX_FILE_SIZE) ?>)</label>
          <input type="file" name="up" id="up" />
          
          <div class="captcha" <?php if (!empty($errors['captcha'])) : ?>style="display:block"<?php endif?>>
            <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php print RECAPTCHA_PUB ?>"></script>
            <noscript>
              <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php print RECAPTCHA_PUB ?>" height="300" width="500" style="border:none"></iframe><br>
              <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
              <input type="hidden" name="recaptcha_response_field" value="manual_challenge">
            </noscript>
          </div>
          
          <div class="submit">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Convert file to .mo</button>
          </div>
        </div><!-- /.well -->

        <div class="span5 offset1 explanation">
          <h3>.po and .mo files?</h3>
          <p>.po is the file format used by <a href="http://en.wikipedia.org/wiki/Gettext" target="_blank">GNU gettext</a> translation system. To use it, you need to compile the .po files in a more efficient format, the .mo ones. Here you can compile .po files for free.</p>
          <!-- .po es el formato de fichero usado por el sistema de traducción GNU gettext. Para poder usarlo en un programa es necesario compilar los ficheros .po en un formato más eficiente, los .mo. Aquí puedes compilar ficheros .po gratis. -->
        </div>

      </form>
    </div>
    <?php endif ?>
    
    <div class="footer">
      <p>Brought to you by <a rel="author" href="http://israelviana.es/?utm_source=PoCompiler&amp;utm_medium=FooterLink&amp;utm_campaign=PoCompiler">Israel Viana</a>. Doubts or comments? <a href="http://israelviana.es/contacto/">Contact me</a>!</p>
    </div>
    
    <a href="https://github.com/isra00/online-po-compile"><img style="position: absolute; top: 0; right: 0; border: 0;" src="/forkme.png" alt="This site is Free Software"></a>
    
    <script type="text/javascript" src="/assets/jquery.min.js"></script>
    <script>
    $(function() {
        $("#up").change(function() {
            $(".captcha").show();
            $("#recaptcha_response_field").focus();
            _gaq.push(['_trackEvent', 'Interactions', 'Select file', 'filename', $("#up").val()]);
        });
        
        $("#submit").click(function(e) {
            if ($("#up").val().length == 0) {
                alert("Please select a .po file to upload");
                e.preventDefault();
                _gaq.push(['_trackEvent', 'Form validation', 'Submit without file']);
            } else {
                if ($("#recaptcha_response_field").val().length == 0) {
                    alert("Please enter the anti-robots text");
                    e.preventDefault();
                    _gaq.push(['_trackEvent', 'Form validation', 'Submit without captcha']);
                }
            }
        });
        
        $(".download-button").click(function() {
            _gaq.push(['_trackEvent', 'Interactions', 'Download', 'File ID', $(this).data("file-id")]);
        });
    });
    </script>
  </body>
</html>
