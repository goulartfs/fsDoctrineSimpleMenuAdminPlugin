<h2>Menu</h2>
<div class="content-box">
    <div class="content-box-content">
        <?php if ($sf_user->hasFlash('notice')): ?>
            <div class="notification information png_bg">
                <a class="close" href="#">Fechar</a>
                <div><?php print $sf_user->getFlash('notice') ?></div>
            </div>
        <?php endif; ?>
        <div class="sf_admin_form">
            <div class="row-fluid" style="top: 0px; margin-top: 15px; position: fixed;">
                <div id="response" class="span7 alert">...</div>
            </div>

            <div id="menu-block" class="row">
                <div id="sidebar-menu"  class="span4">
                    <?php if(count($list_of_models)) include_partial('fsMenu/modelToSelect', array('models'=>$list_of_models)); ?>
                    <?php if(count($list_of_modules)) include_partial('fsMenu/moduleToSelect', array('modules'=>$list_of_modules)); ?>
                    <div class="block thumbnail">
                        <form action="<?php print url_for('fsMenu/createMenu') ?>">
                            <fieldset>
                                <legend>Custom</legend>
                                <input name="menu[type]" type="hidden" value="custom" />
                                <input name="menu[route]" type="hidden" value="" />
                                <input name="menu[link]" type="hidden" value="" />
                                <label for="menu_label">Label:</label>
                                <input id="menu_label" name="menu[label]" type="text" placeholder="Nome do menu" />
                                <label for="menu_label_en">Label Inglês:</label>
                                    <input id="menu_label_en" name="menu[label_en]" type="text" placeholder="Nome do menu em inglês" />
                                <span class="help-block">Nome que será exibido no menu</span>

                                <label for="menu_url">Link</label>
                                <input id="menu_label" name="menu[refer_id]" type="text" placeholder="http://" />
                                <span class="help-block">Url completa para redirecionamento</span>

                                <label class="checkbox">
                                    <input type="checkbox" name="menu[is_blank]"> Abre em outra janela?
                                </label>
                                <button type="button" class="btn btn-block btn-primary add">Adicionar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div id="content-list" class="span7 offset1">
                    <div id="list">
                        <input id="updateAction" type="hidden" value="<?php print url_for('fsMenu/updateList') ?>"/>
                        <ul class="connectedSortable" data-parent="">
                            <?php
                            foreach ($menu as $item) {
                                include_partial('fsMenu/listMenuItem', array('item' => $item));
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>