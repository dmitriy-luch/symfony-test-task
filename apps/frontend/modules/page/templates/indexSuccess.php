<div id="pitch">
    <p>This is the HomePage!</p>
    <p>Our shop has <?= (count($currencies))? 'a lot of' : 'not any' ?> currencies!</p>
    <?php if(count($currencies)): ?>
        <ul>
        <?php foreach($currencies as $currency): ?>
            <li><?= $currency->code ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif ?>
</div>


