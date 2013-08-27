<div class="block thumbnail">
    <form action="<?php print url_for('fsMenu/createMenu') ?>">
        <fieldset>
            <legend>Módulos</legend>
            <input name="menu[type]" type="hidden" value="module"/>
            <input name="menu[link]" type="hidden" value=""/>
            <input name="menu[route]" type="hidden" value=""/>
            <label for="menu_label">Label:</label>
            <input id="menu_label" name="menu[label]" type="text" placeholder="Nome do menu" />
            <label for="menu_label_en">Label Inglês:</label>
            <input id="menu_label_en" name="menu[label_en]" type="text" placeholder="Nome do menu em inglês" />
            <span class="help-block">Nome que será exibido no menu</span>

            <label for="menu_link">Módulos:</label>
            <select id="menu_link" name="menu[refer_id]">
                <?php
                foreach ($modules as $modulo) {
                    print "<option value={$modulo['route']}>{$modulo['title']}</option>";
                }
                ?>
            </select>
            <button type="button" class="btn btn-block btn-primary add">Adicionar</button>
        </fieldset>
    </form>
</div>