<?php
include_once('config.php');
?><html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.2/moment.min.js"></script>
</head>

<body>
<span class="countdown-days"></span>日と、<span class="countdown-time"></span>後にページが更新されます

<script type="text/javascript">
  function onNavigationLoaded(response){
    console.log(response);
    if(response.body.next_step !== undefined && response.body.next_step !== null){
      console.log('aaa');
      var redirectAt = moment.unix(response.body.next_step.at);

      var intervalId = setInterval( function(){
        var now = moment();
        if(now < redirectAt){
          // countdown timer
          $('.countdown-days').text(moment.duration(redirectAt - now).days() );
          $('.countdown-time').text(moment.utc(redirectAt - now).format('HH時間mm分ss秒SS'));
        }
      }, 10);
    }
  }
</script>
<!-- 以下の`example.ever.bz`と、`sales`を、適切なものに置き換えてください -->
<script src="<?php echo $smartLinkApiUrl; ?>"></script>
</body>
</html>