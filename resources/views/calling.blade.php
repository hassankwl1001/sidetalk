<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2again</title>


<script src="//sdk.twilio.com/js/video/releases/2.17.1/twilio-video.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<style>
    body, html {
    height: 100%;
    width:100%;
    text-align: center;
    background:#dcdcdc;
  margin:0;
  padding:0;
  position:relative;
}
h1 {
  color:#4a4a4a;
  text-align:center;
}
img {
  margin: 0 auto;
  display:block;
}
/*PRELOADING------------ */
#overlayer {
  width:100%;
  height:100%;
  position:absolute;
  z-index:1;
  background:#4a4a4a;
}
.loader {
  display: inline-block;
  width: 30px;
  height: 30px;
  position: absolute;
  z-index:3;
  border: 4px solid #Fff;
  top: 50%;
  animation: loader 2s infinite ease;
}

.loader-inner {
  vertical-align: top;
  display: inline-block;
  width: 100%;
  background-color: #fff;
  animation: loader-inner 2s infinite ease-in;
}

@keyframes loader {
  0% {
    transform: rotate(0deg);
  }

  25% {
    transform: rotate(180deg);
  }

  50% {
    transform: rotate(180deg);
  }

  75% {
    transform: rotate(360deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

@keyframes loader-inner {
  0% {
    height: 0%;
  }

  25% {
    height: 0%;
  }

  50% {
    height: 100%;
  }

  75% {
    height: 100%;
  }

  100% {
    height: 0%;
  }
}

    video{
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        position: fixed;
        top: 0;
        left: 0;
    }



    .Center{

        margin:auto;
        padding:2%;
        position: absolute;
        top: 0; left: 0; bottom: 0; right: 0;
        z-index: 1;
    }
    .btn-bot{
        position:absolute;
        margin-left:-50px;
        left:50%;
        width:100px;
        bottom:15px;
    }


</style>
</head>
<body>

<div id="overlayer" style="color: white; font-weight:bold;">
    <p style="margin-top: 27%;">Waiting for Other person to join</p>
</div>

    <span class="loader">
        <span class="loader-inner"></span>
    </span>


<div class='Center' align='center'>
{{--    <button class='btn-bot'>Bottom button</button>--}}
    <a href="{{route('home')}}"> <img class='btn-bot' src="{{asset('end-call.svg')}}" width="60px" height="60px"/></a>
</div>


<script>
$(window).load(function() {
	$(".loader").delay(2000).fadeOut("slow");
  $("#overlayer").delay(2000).fadeOut("slow");
})

const Video = Twilio.Video;
Video.connect('{{ $token }}', { name: 'room-name' }).then(room => {
  console.log('Connected to Room "%s"', room.name);

  room.participants.forEach(participantConnected);
  room.on('participantConnected', participantConnected);

  room.on('participantDisconnected', participantDisconnected);
  room.once('disconnected', error => room.participants.forEach(participantDisconnected));
});

function participantConnected(participant) {
  console.log('Participant "%s" connected', participant.identity);

  $(".loader").delay(2000).fadeOut("slow");
  $("#overlayer").delay(2000).fadeOut("slow");

  const div = document.createElement('div');
  div.id = participant.sid;
  div.innerText = participant.identity;

  participant.on('trackSubscribed', track => trackSubscribed(div, track));
  participant.on('trackUnsubscribed', trackUnsubscribed);

  participant.tracks.forEach(publication => {
    if (publication.isSubscribed) {
      trackSubscribed(div, publication.track);
    }
  });

  document.body.appendChild(div);
}

function participantDisconnected(participant) {
  console.log('Participant "%s" disconnected', participant.identity);
  document.getElementById(participant.sid).remove();
}

function trackSubscribed(div, track) {
  div.appendChild(track.attach());
}

function trackUnsubscribed(track) {
  track.detach().forEach(element => element.remove());
}

</script>

</body>
</html>
