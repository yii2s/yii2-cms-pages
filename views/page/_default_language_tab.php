<?php
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use infoweb\pages\models\Page;
?>
<div class="tab-content language-tab">

    <?= $form->field($model, "[{$model->language}]name")->textInput([
        'maxlength' => 255,
        'name' => "PageLang[{$model->language}][name]",
        'data-slugable' => 'true',
        'data-slug-target' => "#aliaslang-{$model->language}-url",
        'readonly' => ($page->type == Page::TYPE_SYSTEM && !Yii::$app->user->can('Superadmin')) ? true : false
    ]); ?>
    
    <?= $form->field($alias, "[{$alias->language}]url")->textInput([
        'maxlength' => 255,
        'name' => "AliasLang[{$alias->language}][url]",
        //'placeholder' => '/'.$model->language.'/',
        'data-slugified' => 'true',
        'readonly' => ($page->type == Page::TYPE_SYSTEM && !Yii::$app->user->can('Superadmin')) ? true : false
    ]); ?>
    
    <?= $form->field($model, "[{$model->language}]title")->textInput([
        'maxlength' => 255,
        'name' => "PageLang[{$model->language}][title]"
    ]); ?>
    
    <?= $form->field($model, "[{$model->language}]content")->widget(CKEditor::className(), [
        'name' => "PageLang[{$model->language}][content]",
        'editorOptions' => ArrayHelper::merge(Yii::$app->getModule('cms')->getCKEditorOptions(), Yii::$app->getModule('pages')->ckEditorOptions),
    ]); ?>
    
    <?= $form->field($model, "[{$model->language}]snippet")->widget(CKEditor::className(), [
        'name' => "PageLang[{$model->language}][snippet]",
        'editorOptions' => ArrayHelper::merge(
            Yii::$app->getModule('cms')->getCKEditorOptions(),
            Yii::$app->getModule('pages')->ckEditorOptions,
            [
                'height' => 200,
                'contentsCss' => [Yii::getAlias('@frontendUrl') . '/css/ckeditor/page-snippet.css'],
            ]
        ),
    ]); ?> 
</div>