<?php namespace Prismify\Toolbox\Behaviors;

use Backend;
use October\Rain\Support\Facades\Config;
use Backend\Classes\Controller;
use Backend\Classes\ControllerBehavior;

class DrawerController extends ControllerBehavior
{
    const CREATE_FORM   = '$/prismify/toolbox/partials/drawers/_template_create.htm';
    const UPDATE_FORM   = '$/prismify/toolbox/partials/drawers/_template_update.htm';
    const PREVIEW_FORM  = '$/prismify/toolbox/partials/drawers/_template_preview.htm';

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * Behavior constructor
     *
     * @param   Controller  $controller
     */
    public function __construct($controller){

        parent::__construct($controller);

        $this->controller = $controller;

        $this->getToolboxAssets();
    }

    public function onCreateDrawerRecordForm()
    {
        $this->controller->asExtension('FormController')->create();

        return $this->controller->makePartial(self::CREATE_FORM);
    }

    public function onCreateRecord()
    {
        $this->controller->asExtension('FormController')->create_onSave();

        return $this->controller->listRefresh();
    }

    public function onUpdateDrawerRecordForm($record_id)
    {
        $this->controller->asExtension('FormController')->update($record_id);

        return $this->controller->makePartial(self::UPDATE_FORM);
    }

    public function onUpdateRecord($record_id)
    {
        $this->controller->asExtension('FormController')->update_onSave($record_id);

        return $this->controller->listRefresh();
    }

    public function onPreviewDrawerRecordForm($record_id)
    {
        $this->controller->asExtension('FormController')->preview($record_id);

        return $this->controller->makePartial(self::PREVIEW_FORM);
    }

    public function onDeleteRecord($record_id)
    {
        $this->controller->asExtension('FormController')->update_onDelete($record_id);

        return $this->controller->listRefresh();
    }

    public function getToolboxAssets()
    {
        $this->addCss('/plugins/prismify/toolbox/assets/css/toolbox.css', 'Prismify.Toolbox');

        if (Config::get('develop.decompileBackendAssets', false)) {
            // Allow decompiled backend assets for Primsify.Toolbox
            $assets = Backend::decompileAsset('../../plugins/prismify/toolbox/assets/js/toolbox.js', true);

            foreach ($assets as $asset) {
                $this->addJs($asset, 'Prismify.Toolbox');
            }
        } else {
            $this->addJs('/plugins/prismify/toolbox/assets/js/toolbox-min.js', 'Prismify.Toolbox');
        }
    }
}
