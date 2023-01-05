<h1><?= $headline ?></h1>
<?= validation_errors() ?>
<div class="card">
    <div class="card-heading">
        Story Details
    </div>
    <div class="card-body">
        <?php
        echo form_open($form_location);
        echo form_label('Original Headline');
        echo form_input('original_headline', $original_headline, array("placeholder" => "Enter Original Headline"));
        echo form_label('Funny Headline <span>(optional)</span>');
        echo form_textarea('funny_headline', $funny_headline, array("placeholder" => "Enter Funny Headline"));
        echo form_label('Picture <span>(optional)</span>');
        echo form_textarea('picture', $picture, array("placeholder" => "Enter Picture"));
        echo form_submit('submit', 'Submit');
        echo anchor($cancel_url, 'Cancel', array('class' => 'button alt'));
        echo form_close();
        ?>
    </div>
</div>