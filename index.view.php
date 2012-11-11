<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>On-line .po compiler, convert your .po files into .mo - FREE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Convert your .po files into .mo on-line for free - online msgfmt">
    <meta name="keywords" content="msgfmt, gettext, gnu gettext, convert, online, free, po, mo, po file, mo file, po converter">
    <meta name="author" content="Israel Viana">

    <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <style>
      .captcha { margin: 1em 0; display: none; }
      .submit { margin-top: 1em; }
      .footer { text-align: center; }
      .download-page { text-align: center; }
      .download { margin-top: 2em; }
      .download .btn { padding: 15px 25px; }
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
  
    <?php if (isset($deliver)) : ?>
    
    <div class="hero-unit download-page">
      <h1>Done! Here you have it</h1>
      <p class="download"><a class="btn btn-large btn-success" href="<?php print $download_url ?>">Download your compiled .mo file</a></p>
    </div>
    
    <?php else : ?>
  
    <div class="hero-unit">
      <h1>Convert .po files into .mo</h1>
      <p>Quick, easy and for free</p>
      <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
      
        <?php if (!empty($errors)) : ?>
        <div class="alert alert-error">
          <ul>
            <li><?php print join('</li><li>', $errors) ?></li>
          </ul>
        </div>
        <?php endif ?>
      
        <div class="form-actions">
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
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Convert to .mo</button>
          </div>
        </div><!-- /.form-actions -->
      </form>
    </div>
    <?php endif ?>
    
    <div class="footer">
        <p>Brought to you by <a href="http://israelviana.es/?utm_source=PoConverter&amp;utm_medium=FooterLink&amp;utm_campaign=PoConverter">Israel Viana</a></p>
    </div>
    
    <a href="https://github.com/isra00/online-po-compile"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_orange_ff7600.png" alt="This site is Free Software"></a>
    
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>
    $(function() {
        $("#up").change(function() {
            $(".captcha").show();
            $("#recaptcha_response_field").focus();
        });
        
        $("#submit").click(function(e) {
            if ($("#up").val().length == 0) {
                alert("Please select a .po file to upload");
                e.preventDefault();
            }
        });
    });
    </script>
  </body>
</html>
