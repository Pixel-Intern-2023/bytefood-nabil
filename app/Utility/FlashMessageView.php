<div class="alert alert-success" role="alert">
    <h1><?= $data['title']?></h1>
    <p class="text-secondary"><?= $data['subtitle']?></p>
    <ul>
        <?php foreach( $data['data'] as $key => $value){?>
        <li><?= $key . " : " . $value?></li>
        <?php  }?>
    </ul>
</div>