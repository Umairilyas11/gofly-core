<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

use Egns_Core\Egns_Helper;
use Elementor\Group_Control_Typography;

class Gofly_Tour_Social_Share_Widget extends Widget_Base
{
    public function get_name()       { return 'gofly_tour_social_share'; }
    public function get_title()      { return esc_html__('EG Tour Social Share', 'gofly-core'); }
    public function get_icon()       { return 'egns-widget-icon'; }
    public function get_categories() { return ['gofly_tour']; }

    protected function register_controls()
    {
        // ===================== Content ===================== //
        $this->start_controls_section('gofly_share_content', ['label' => esc_html__('Content', 'gofly-core')]);

        $this->add_control('gofly_share_notice', [
            'type' => \Elementor\Controls_Manager::NOTICE, 'notice_type' => 'info', 'dismissible' => true,
            'heading' => esc_html__('Notice', 'gofly-core'),
            'content' => esc_html__('Shares the current tour page URL and title. Works on Tour detail pages.', 'gofly-core'),
        ]);

        $this->add_control('gofly_share_label', [
            'label'       => esc_html__('Share Label', 'gofly-core'),
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => esc_html__('Share this deal:', 'gofly-core'),
            'label_block' => true,
        ]);

        $this->add_control('gofly_share_layout', [
            'label'   => esc_html__('Layout', 'gofly-core'),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'icon_only'  => esc_html__('Icon Only', 'gofly-core'),
                'icon_label' => esc_html__('Icon + Label', 'gofly-core'),
            ],
            'default' => 'icon_only',
        ]);

        $this->add_control('gofly_share_style_type', [
            'label'   => esc_html__('Button Style', 'gofly-core'),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'circle'   => esc_html__('Circle', 'gofly-core'),
                'rounded'  => esc_html__('Rounded', 'gofly-core'),
                'square'   => esc_html__('Square', 'gofly-core'),
            ],
            'default' => 'circle',
        ]);

        $this->add_control('gofly_share_show_facebook', [
            'label' => esc_html__('Show Facebook', 'gofly-core'), 'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes', 'default' => 'yes',
        ]);
        $this->add_control('gofly_share_show_twitter', [
            'label' => esc_html__('Show X (Twitter)', 'gofly-core'), 'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes', 'default' => 'yes',
        ]);
        $this->add_control('gofly_share_show_whatsapp', [
            'label' => esc_html__('Show WhatsApp', 'gofly-core'), 'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes', 'default' => 'yes',
        ]);
        $this->add_control('gofly_share_show_email', [
            'label' => esc_html__('Show Email', 'gofly-core'), 'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes', 'default' => 'yes',
        ]);
        $this->add_control('gofly_share_show_copy', [
            'label' => esc_html__('Show Copy Link', 'gofly-core'), 'type' => Controls_Manager::SWITCHER,
            'return_value' => 'yes', 'default' => 'yes',
        ]);
        $this->add_control('gofly_share_copy_tooltip', [
            'label'   => esc_html__('Copy Success Text', 'gofly-core'),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__('Link Copied!', 'gofly-core'),
            'condition' => ['gofly_share_show_copy' => 'yes'],
        ]);

        $this->end_controls_section();

        // ===================== Style ===================== //
        $this->start_controls_section('gofly_share_style', [
            'label' => esc_html__('Style', 'gofly-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('gofly_share_label_color', [
            'label' => esc_html__('Label Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .eg-share-label' => 'color: {{VALUE}};'],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'gofly_share_label_typ',
            'label'    => esc_html__('Label Typography', 'gofly-core'),
            'selector' => '{{WRAPPER}} .eg-share-label',
        ]);

        $this->add_control('gofly_share_btn_size', [
            'label'   => esc_html__('Button Size (px)', 'gofly-core'),
            'type'    => Controls_Manager::NUMBER,
            'default' => 40, 'min' => 28, 'max' => 80,
            'selectors' => [
                '{{WRAPPER}} .eg-share-btn' => 'width: {{VALUE}}px; height: {{VALUE}}px;',
            ],
        ]);

        $this->add_control('gofly_share_icon_size', [
            'label'   => esc_html__('Icon Size (px)', 'gofly-core'),
            'type'    => Controls_Manager::NUMBER,
            'default' => 18, 'min' => 10, 'max' => 40,
            'selectors' => [
                '{{WRAPPER}} .eg-share-btn svg' => 'width: {{VALUE}}px; height: {{VALUE}}px;',
            ],
        ]);

        $this->add_control('gofly_share_gap', [
            'label'   => esc_html__('Button Gap (px)', 'gofly-core'),
            'type'    => Controls_Manager::NUMBER,
            'default' => 8, 'min' => 0, 'max' => 40,
            'selectors' => [
                '{{WRAPPER}} .eg-share-btns' => 'gap: {{VALUE}}px;',
            ],
        ]);

        // Per-platform colour overrides
        $this->add_control('gofly_share_fb_color', [
            'label' => esc_html__('Facebook Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'default' => '#1877F2',
            'selectors' => ['{{WRAPPER}} .eg-share-btn.eg-share-fb' => 'background-color: {{VALUE}};'],
        ]);
        $this->add_control('gofly_share_tw_color', [
            'label' => esc_html__('X (Twitter) Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => ['{{WRAPPER}} .eg-share-btn.eg-share-tw' => 'background-color: {{VALUE}};'],
        ]);
        $this->add_control('gofly_share_wa_color', [
            'label' => esc_html__('WhatsApp Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'default' => '#25D366',
            'selectors' => ['{{WRAPPER}} .eg-share-btn.eg-share-wa' => 'background-color: {{VALUE}};'],
        ]);
        $this->add_control('gofly_share_em_color', [
            'label' => esc_html__('Email Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'default' => '#EA4335',
            'selectors' => ['{{WRAPPER}} .eg-share-btn.eg-share-em' => 'background-color: {{VALUE}};'],
        ]);
        $this->add_control('gofly_share_cp_color', [
            'label' => esc_html__('Copy Link Color', 'gofly-core'), 'type' => Controls_Manager::COLOR,
            'default' => '#6b7280',
            'selectors' => ['{{WRAPPER}} .eg-share-btn.eg-share-cp' => 'background-color: {{VALUE}};'],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings   = $this->get_settings_for_display();
        $page_url   = urlencode(get_permalink());
        $page_title = urlencode(get_the_title());
        $raw_url    = get_permalink();
        $label      = esc_html($settings['gofly_share_label'] ?? 'Share this deal:');
        $layout     = $settings['gofly_share_layout'] ?? 'icon_only';
        $shape      = $settings['gofly_share_style_type'] ?? 'circle';
        $copy_text  = esc_js($settings['gofly_share_copy_tooltip'] ?? 'Link Copied!');
        $wid        = 'eg-share-' . $this->get_id();

        $radius = ['circle' => '50%', 'rounded' => '8px', 'square' => '4px'][$shape] ?? '50%';

        $btn_size = !empty($settings['gofly_share_btn_size']) ? intval($settings['gofly_share_btn_size']) : 40;
        $icon_size = !empty($settings['gofly_share_icon_size']) ? intval($settings['gofly_share_icon_size']) : 18;

        // Share URLs
        $fb_url  = 'https://www.facebook.com/sharer/sharer.php?u=' . $page_url;
        $tw_url  = 'https://twitter.com/intent/tweet?url=' . $page_url . '&text=' . $page_title;
        $wa_url  = 'https://api.whatsapp.com/send?text=' . $page_title . '%20' . $page_url;
        $em_url  = 'mailto:?subject=' . $page_title . '&body=' . $page_url;

        $platforms = [];
        if (($settings['gofly_share_show_facebook'] ?? 'yes') === 'yes') {
            $platforms[] = [
                'class' => 'eg-share-fb', 'href' => $fb_url, 'target' => '_blank', 'title' => 'Share on Facebook',
                'label' => 'Facebook',
                'icon'  => '<svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
            ];
        }
        if (($settings['gofly_share_show_twitter'] ?? 'yes') === 'yes') {
            $platforms[] = [
                'class' => 'eg-share-tw', 'href' => $tw_url, 'target' => '_blank', 'title' => 'Share on X',
                'label' => 'X (Twitter)',
                'icon'  => '<svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
            ];
        }
        if (($settings['gofly_share_show_whatsapp'] ?? 'yes') === 'yes') {
            $platforms[] = [
                'class' => 'eg-share-wa', 'href' => $wa_url, 'target' => '_blank', 'title' => 'Share on WhatsApp',
                'label' => 'WhatsApp',
                'icon'  => '<svg viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>',
            ];
        }
        if (($settings['gofly_share_show_email'] ?? 'yes') === 'yes') {
            $platforms[] = [
                'class' => 'eg-share-em', 'href' => $em_url, 'target' => '_self', 'title' => 'Share via Email',
                'label' => 'Email',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>',
            ];
        }
        if (($settings['gofly_share_show_copy'] ?? 'yes') === 'yes') {
            $platforms[] = [
                'class' => 'eg-share-cp eg-share-copy-btn', 'href' => '#', 'target' => '_self', 'title' => 'Copy link',
                'label' => 'Copy Link',
                'icon'  => '<svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>',
            ];
        }

        $btn_style_base = 'display:inline-flex;align-items:center;justify-content:center;border:none;cursor:pointer;text-decoration:none;transition:opacity .2s,transform .15s;width:' . $btn_size . 'px;height:' . $btn_size . 'px;border-radius:' . $radius . ';';
?>
<style>
#<?php echo esc_attr($wid); ?> .eg-share-wrap{display:flex;align-items:center;gap:12px;flex-wrap:wrap}
#<?php echo esc_attr($wid); ?> .eg-share-label{font-size:14px;font-weight:600;color:#444;white-space:nowrap}
#<?php echo esc_attr($wid); ?> .eg-share-btns{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
#<?php echo esc_attr($wid); ?> .eg-share-btn{display:inline-flex;align-items:center;justify-content:center;border:none;cursor:pointer;text-decoration:none;transition:opacity .2s,transform .15s;width:<?php echo $btn_size; ?>px;height:<?php echo $btn_size; ?>px;border-radius:<?php echo $radius; ?>;}
#<?php echo esc_attr($wid); ?> .eg-share-btn:hover{opacity:.85;transform:scale(1.08)}
#<?php echo esc_attr($wid); ?> .eg-share-btn svg{width:<?php echo $icon_size; ?>px;height:<?php echo $icon_size; ?>px;flex-shrink:0}
#<?php echo esc_attr($wid); ?> .eg-share-btn.eg-share-fb{background:#1877F2}
#<?php echo esc_attr($wid); ?> .eg-share-btn.eg-share-tw{background:#000}
#<?php echo esc_attr($wid); ?> .eg-share-btn.eg-share-wa{background:#25D366}
#<?php echo esc_attr($wid); ?> .eg-share-btn.eg-share-em{background:#EA4335}
#<?php echo esc_attr($wid); ?> .eg-share-btn.eg-share-cp{background:#6b7280}
/* icon+label layout */
#<?php echo esc_attr($wid); ?> .eg-share-btn.has-label{width:auto;padding:0 14px;gap:7px;font-size:13px;font-weight:600;color:#fff;height:<?php echo $btn_size; ?>px}
/* tooltip */
.eg-share-tooltip{position:fixed;background:#1a1a1a;color:#fff;font-size:12px;padding:5px 12px;border-radius:20px;pointer-events:none;opacity:0;transition:opacity .25s;z-index:99999;white-space:nowrap}
.eg-share-tooltip.show{opacity:1}
</style>

<div id="<?php echo esc_attr($wid); ?>">
    <div class="eg-share-wrap">
        <?php if (!empty($label)): ?>
            <span class="eg-share-label"><?php echo $label; ?></span>
        <?php endif; ?>
        <div class="eg-share-btns">
            <?php foreach ($platforms as $p):
                $has_label_class = ($layout === 'icon_label') ? ' has-label' : '';
            ?>
            <a href="<?php echo esc_url($p['href']); ?>"
               target="<?php echo esc_attr($p['target']); ?>"
               rel="noopener noreferrer"
               title="<?php echo esc_attr($p['title']); ?>"
               class="eg-share-btn <?php echo esc_attr($p['class'] . $has_label_class); ?>">
                <?php echo $p['icon']; ?>
                <?php if ($layout === 'icon_label'): ?>
                    <span><?php echo esc_html($p['label']); ?></span>
                <?php endif; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Copy tooltip -->
<div class="eg-share-tooltip" id="<?php echo esc_attr($wid); ?>-tooltip"><?php echo esc_html($settings['gofly_share_copy_tooltip'] ?? 'Link Copied!'); ?></div>

<script>
(function(){
    var wid     = <?php echo json_encode($wid); ?>;
    var wrap    = document.getElementById(wid);
    var tooltip = document.getElementById(wid+'-tooltip');
    var rawUrl  = <?php echo json_encode($raw_url); ?>;
    if(!wrap) return;

    var copyBtn = wrap.querySelector('.eg-share-copy-btn');
    if(copyBtn){
        copyBtn.addEventListener('click',function(e){
            e.preventDefault();
            if(navigator.clipboard){
                navigator.clipboard.writeText(rawUrl).then(function(){ showTooltip(e); });
            } else {
                var ta=document.createElement('textarea');
                ta.value=rawUrl;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                showTooltip(e);
            }
        });
    }

    function showTooltip(e){
        if(!tooltip) return;
        tooltip.style.left=(e.clientX-40)+'px';
        tooltip.style.top=(e.clientY-38)+'px';
        tooltip.classList.add('show');
        setTimeout(function(){ tooltip.classList.remove('show'); },2000);
    }

    // Open social links in popup window
    wrap.querySelectorAll('.eg-share-btn[target="_blank"]').forEach(function(a){
        a.addEventListener('click',function(e){
            e.preventDefault();
            var w=600,h=500;
            var left=(screen.width/2)-(w/2);
            var top=(screen.height/2)-(h/2);
            window.open(this.href,'share','width='+w+',height='+h+',left='+left+',top='+top+',toolbar=0,scrollbars=1');
        });
    });
})();
</script>
<?php
    }
}
Plugin::instance()->widgets_manager->register(new Gofly_Tour_Social_Share_Widget());
