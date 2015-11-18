<?php if (!empty($this->items)) : ?>

    <section class="slider">

        <div class="slides">
            <?php foreach ($this->items as $item) : ?>
                <div class="slide">

	                <?php if ($item->hideOverlying == 'N') : ?>

	                    <article class="txt col-md-7 col-xs-12">
		                    <?php if ($this->settings['colors'] && !empty($item->color)) : ?>
			                    <span style="color: #<?= $item->color; ?>"><?= $item->alt; ?></span>
		                    <?php else : ?>
			                    <span><?= $item->alt; ?></span>
		                    <?php endif; ?>

	                        <?php if ($this->settings['buttons'] === 'Y' && !empty($item->buttons)) :
	                            $buttons = unserialize($item->buttons);
	                            $buttonCount = count($buttons['text']); ?>

		                        <div class="buttons">

		                            <?php for ($i = 0; $i < $buttonCount; $i++) :
		                                echo sprintf('
		                                    <a href="%s" class="btn">
		                                        %s
		                                    </a>
		                                ', $buttons['url'][$i], $buttons['text'][$i]);
		                            endfor; ?>

	                            </div>
	                        <?php endif; ?>
	                    </article>

                    <?php endif; ?>

	                <?php if ($item->hideOverlying == 'Y' && !empty($item->link)) : ?>
		                <a href="<?= $item->link; ?>">
			                <figure style="background-image: url('<?= $item->file; ?>');"></figure>
		                </a>
	                <?php else : ?>
		                <figure style="background-image: url('<?= $item->file; ?>');"></figure>
	                <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </section>

<?php endif; ?>