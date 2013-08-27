<?php if (count($models)) { ?>
    <?php foreach ($models as $type => $values) { ?>
        <div class="block thumbnail">
            <form action="<?php print url_for('fsMenu/createMenu') ?>">
                <fieldset>
                    <legend><?php print $values['title'] ?></legend>
                    <input name="menu[type]" type="hidden" value="<?php print $type ?>"/>
                    <input name="menu[is_generated_after]" type="hidden" value="<?php print $values['is_generated_after'] ?>"/>
                    <input name="menu[link]" type="hidden" value="<?php print $values['link'] ?>"/>
                    <input name="menu[route]" type="hidden" value="<?php print $values['route'] ?>"/>
                    <label for="menu_label">Label:</label>
                    <input id="menu_label" name="menu[label]" type="text" placeholder="Nome do menu" />
                    <label for="menu_label_en">Label Inglês:</label>
                    <input id="menu_label_en" name="menu[label_en]" type="text" placeholder="Nome do menu em inglês" />
                    <span class="help-block">Nome que será exibido no menu</span>

                    <label for="menu_link"><?php print $values['title'] ?>:</label>
                    <select id="menu_link" name="menu[refer_id]">
                        <?php
                        foreach ($values['options'] as $option_value => $option_label) {
                            print "<option value={$option_value}>{$option_label}</option>";
                        }
                        ?>
                    </select>
                    <button type="button" class="btn btn-block btn-primary add">Adicionar</button>
                </fieldset>
            </form>
        </div>
    <?php } ?>
<?php } ?>