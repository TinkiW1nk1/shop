<!-- BreadCrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <!--<li><a href="index.html">Home</a></li>
                <li class="active">Single</li>-->
                <?=$breadcrumbs;?>
            </ol>
        </div>
    </div>
</div>
<!-- EndBreadCrumbs -->
<!-- Product -->
<?php if($products): ?>

    <?php $curr = \shop2\App::$app->getProperty('currency'); ?>
    <div class="product">
        <div class="container">
            <div class="product-top">
                <div class="product-one">
                    <?php foreach($products as $hit): ?>
                        <div class="col-md-3 product-left">
                            <div class="product-main simpleCart_shelfItem">
                                <a href="product/<?=$hit->alias;?>" class="mask"><img class="img-responsive zoom-img" src="images/<?=$hit->img;?>" alt="" /></a>
                                <div class="product-bottom">
                                    <h3><a href="product/<?=$hit->alias;?>"><?=$hit->title;?></a></h3>
                                    <p>Explore Now</p>
                                    <h4>
                                        <a data-id="<?= $hit->id ?>" class="add-to-cart-link" href="cart/add?id=<?=$hit->id;?>"><i></i></a> <span class=" item_price"><?=$curr['symbol_left'];?><?=$hit->price * $curr['value'];?><?=$curr['symbol_right'];?></span>
                                        <?php if($hit->old_price): ?>
                                            <small><del><?=$curr['symbol_left'];?><?=$hit->old_price * $curr['value'];?><?=$curr['symbol_right'];?></del></small>
                                        <?php endif; ?>
                                    </h4>
                                </div>
                                <div class="srch">
                                    <span>-50%</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>