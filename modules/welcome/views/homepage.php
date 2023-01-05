<h1 class="text-center">Welcome To <?= WEBSITE_NAME ?></h1>
<p class="text-center">Let's blame all of the bad news on a gang of creepy clowns.</p>
<form>
<?php
echo form_label('Original Headline');
$attr['placeholder'] = 'Enter headline here...';
$attr['id'] = 'original-headline';
$attr['autocomplete'] = 'off';
echo form_input('original_headline', '', $attr);
$btn_attr['onclick'] = 'fetchFunnyHeadline()';
echo form_button('submit', 'Submit', $btn_attr);
?>
</form>
<div class="spinner" style="display:none"></div>
<div id="story">
    <h2 class="text-center"></h2>
</div>
<style>
h2 {
    text-transform: uppercase;
}

form {
    max-width: 420px;
    margin: 0 auto;
}

.spinner {
    min-height: 7em;
}

#info-div {
    margin: 3em;
}
</style>

<script>
const origHeadlineEl = document.getElementById('original-headline');
const theForm = document.getElementsByTagName('form')[0];
const spinner = document.getElementsByClassName('spinner')[0];
const funnyHeadlineEl = document.getElementsByTagName('h2')[0];
const storyEl = document.getElementById('story');

function fetchFunnyHeadline() {
    if(origHeadlineEl.value !== '') {

        //clear the contents of the funny headline
        funnyHeadlineEl.innerHTML = '';

        //remove the info-div, if it exists
        const infoDiv = document.getElementById('info-div');
        if(infoDiv) {
            infoDiv.remove();
        }
        
        //hide the form
        theForm.style.display = 'none';

        //display the spinner
        spinner.style.display = 'flex';

        //fetch a funny headline from the API endpoint
        const targetUrl = '<?= BASE_URL ?>api/create/stories';

        const params = {
            original_headline: origHeadlineEl.value
        }

        const http = new XMLHttpRequest();
        http.open('post', targetUrl);
        http.setRequestHeader('Content-type', 'application/json');
        http.send(JSON.stringify(params));
        http.onload = function() {
            
            if (http.status !== 200) {
                handleError(http.responseText);
            } else {
                drawFunnyHeadline(http.responseText);
            }
            
        }
    }
}

function handleError(errorMsg) {
    alert(errorMsg);
    //display the form
    theForm.style.display = 'block';

    //hide the spinner
    spinner.style.display = 'none';

    //clear the form field
    origHeadlineEl.value = '';   
}

function drawFunnyHeadline(jsonStr) {

    const textObj = JSON.parse(jsonStr);

    funnyHeadlineEl.innerHTML = textObj.funny_headline;

    //display the form
    theForm.style.display = 'block';

    //hide the spinner
    spinner.style.display = 'none';

    //generate image
    generateImage(origHeadlineEl.value, textObj.id);

    //clear the form field
    origHeadlineEl.value = '';
}

function generateImage(headline, updateId) {
    
    //create an info div
    const infoDiv = document.createElement('div');
    infoDiv.setAttribute('id', 'info-div');
    infoDiv.setAttribute('class', 'text-center blink');
    infoDiv.innerHTML = '* LOADING PICTURE - PLEASE WAIT *';

    storyEl.insertBefore(infoDiv, funnyHeadlineEl);

    //send the headline and updateId to our custom API
    const targetUrl = '<?= BASE_URL ?>stories/init_gen_image';

    //build an obj containing all the things we want to post
    const params = {
        updateId,
        headline
    }

    //create the HTTP post request
    const http = new XMLHttpRequest();
    http.open('post', targetUrl);
    http.setRequestHeader('Content-type', 'application/json');
    http.send(JSON.stringify(params));
    http.onload = function() {
        
        if (http.status !== 200) {
            handleError(http.responseText);
        } else {
            drawImage(http.responseText);
        }
        
    }
}

function drawImage(picPath) {
    //clear the info div
    const infoDiv = document.getElementById('info-div');
    infoDiv.innerHTML = '';
    infoDiv.classList.remove('blink');

    //create an img on the page
    const newPic = document.createElement('img');
    newPic.setAttribute('src', picPath);

    infoDiv.appendChild(newPic);
}
</script>