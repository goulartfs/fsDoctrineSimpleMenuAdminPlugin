<li id="arrayorder_<?php print $item->getId() ?>">
    <span class="title-list" rel="<?php print $item->getId() ?>"><?php print $item->getLabel(); ?></span>
    <div class="icon-arrow-down pull-right trigger-block"></div>
    <div class="pull-right type-label">Tipo: <?php print $item->getTypeLabel() ?></div>
    <div class="clear"></div>
    <div class="edit-block thumbnail">
        <form action="" data-id="<?php print $item->getId() ?>">
                <input type="hidden" name="menu[id]" value="<?php print $item->getId() ?>"/>
                <input type="hidden" name="menu[type]" value="<?php print $item->getType() ?>"/>
                <label for="item_label_<?php print $item->getId() ?>">Label:</label>
                <input id="item_label_<?php print $item->getId() ?>" name="menu[label]" type="text" placeholder="Nome do menu" value="<?php print $item->getLabel(); ?>"/>
                <label for="item_label_en_<?php print $item->getId() ?>">Label Inglês:</label>
                <input id="item_label_en_<?php print $item->getId() ?>" name="menu[label_en]" type="text" placeholder="Nome do menu em inglês"  value="<?php print $item->getLabelEn(); ?>"/>
            <?php if ($item->getType() == 'custom') { ?>
                    <label for="item_link_<?php print $item->getId() ?>">Link</label>
                    <input id="item_link_<?php print $item->getId() ?>" type="text" placeholder="http://" name="menu[link]" value="<?php print $item->getLink(); ?>"/>
            <?php } ?>
                <label>
                    <input id="item_is_blank_<?php print $item->getId() ?>" type="checkbox" name="menu[is_blank]" <?php print ($item->getIsBlank()) ? "checked" : false  ?>/>
                    Abre em outra janela?
                </label>
            <input data-url="<?php print url_for('fsMenu/removeMenu') ?>" class="remove btn btn-danger" type="button" value="Remover" />
            <input data-url="<?php print url_for('fsMenu/updateMenu') ?>" class="save btn btn-success" type="button" value="Salvar" />
        </form>
    </div>
    <ul data-parent="<?php print $item->getId() ?>" class="connectedSortable <?php print ($item->hasChild()) ? false : "empty"  ?>">
        <?php
        if (($item->hasChild())) {
            foreach ($item->getChild() as $filho) {
                include_partial('fsMenu/listMenuItem', array('item' => $filho));
            }
        }
        ?>
    </ul>
</li>