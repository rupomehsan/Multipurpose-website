<?php

namespace Plugins\PageBuilder\Addons\Tenants\SoftwareBusiness;
use App\Facades\GlobalLanguage;
use App\Helpers\SanitizeInput;
use App\Models\FormBuilder;
use Plugins\PageBuilder\Fields\Image;
use Plugins\PageBuilder\Fields\Repeater;
use Plugins\PageBuilder\Fields\Select;
use Plugins\PageBuilder\Fields\Slider;
use Plugins\PageBuilder\Fields\Text;
use Plugins\PageBuilder\Fields\Textarea;
use Plugins\PageBuilder\Helpers\RepeaterField;
use Plugins\PageBuilder\PageBuilderBase;
use function __;

class HeaderBottomArea extends PageBuilderBase
{

    public function preview_image()
    {
        return 'Tenant/SoftwareBusiness/header-bottom-area.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();

        $widget_saved_values = $this->get_settings();
        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();
        $all_languages = GlobalLanguage::all_languages();

        foreach ($all_languages as $key => $lang) {

            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'left_title_'.$lang->slug,
                'label' => __('Left Title'),
                'value' => $widget_saved_values['left_title_'.$lang->slug] ?? null,
            ]);

            $output .= Textarea::get([
                'name' => 'right_description_'.$lang->slug,
                'label' => __('Right Description'),
                'value' => $widget_saved_values['right_description_'.$lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'button_text_'.$lang->slug,
                'label' => __('Button Text'),
                'value' => $widget_saved_values['button_text_'.$lang->slug] ?? null,
            ]);
            $output .= Text::get([
                'name' => 'button_url_'.$lang->slug,
                'label' => __('Button URL'),
                'value' => $widget_saved_values['button_url_'.$lang->slug] ?? null,
            ]);

            $output .= $this->admin_language_tab_content_end();
        }
        $output .= $this->admin_language_tab_end(); //have to end language tab


        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'multi_lang' => true,
            'id' => 'software_banner_bottom_repeater',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'repeater_title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXTAREA,
                    'name' => 'repeater_description',
                    'label' => __('Description')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'repeater_more_text',
                    'label' => __('More Text')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'repeater_more_url',
                    'label' => __('More URL')
                ],

                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'repeater_image',
                    'label' => __('Image')
                ],
            ]
        ]);


        // add padding option
        $output .= $this->padding_fields($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $current_lang = get_user_lang();
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        $left_title = SanitizeInput::esc_html($this->setting_item('left_title_'.$current_lang)) ?? '';
        $right_description = SanitizeInput::esc_html($this->setting_item('right_description_'.$current_lang)) ?? '';
        $button_text = SanitizeInput::esc_html($this->setting_item('button_text_'.$current_lang)) ?? '';
        $button_url = SanitizeInput::esc_html($this->setting_item('button_url_'.$current_lang)) ?? '';
        $repeater_data = $this->setting_item('software_banner_bottom_repeater');

        $data = [
            'padding_top'=> $padding_top,
            'padding_bottom'=> $padding_bottom,
            'repeater_data'=> $repeater_data,
            'left_title'=> $left_title,
            'right_description'=> $right_description,
            'button_text'=> $button_text,
            'button_url'=> $button_url,
        ];

        return self::renderView('tenant.software-business.header-bottom-area',$data);
    }

    public function enable(): bool
    {
        return !is_null(tenant());
    }

    public function addon_title()
    {
        return __('Header Bottom (Software)');
    }
}
