<div class="row text-center">
<?php $pager->setSurroundCount(4) ?>

<nav aria-label="Products page navigation">
    <ul class="pagination justify-content-center p-4">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>"><?= lang('Pager.first') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPrevious() ?>"><?= lang('Pager.previous') ?></span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link): ?>
        <li class="page-item <?= $link['active'] ? 'active disabled' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <lili class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>"><?= lang('Pager.next') ?></span>
            </a>
        </li>
        <lili class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>"><?= lang('Pager.last') ?></span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>
</div>