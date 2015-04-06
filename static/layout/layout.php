<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo autoload::htmlHeaders(); ?>
    <?php echo autoload::stylesheetFiles(); ?>
    <?php echo autoload::javascriptFiles(); ?>
  </head>
  <body>
    <?php echo page::renderComponent('pageContent','pageContentHeader'); ?>
    <?php echo $aadya_contents; ?>
    <?php echo page::renderTemplate('pageContent','pageContentFooter'); ?>
  </body>
</html>