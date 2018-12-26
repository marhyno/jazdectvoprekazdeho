<?php

/* @oneall_sociallogin/event/overall_header_content_before.html */
class __TwigTemplate_65359b9dac664552277e076703caa2716af0727654d3d2a9c8474946045ed4e7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        if (($context["OA_SOCIAL_LOGIN_EMBED_SOCIAL_LOGIN"] ?? null)) {
            echo " 
\t<div class=\"panel\">
\t\t<div class=\"inner\">
\t\t\t<div class=\"content\">
\t\t\t\t";
            // line 5
            if (($context["OA_SOCIAL_LOGIN_PAGE_CAPTION"] ?? null)) {
                // line 6
                echo "\t\t\t\t\t<h2 class=\"login-title\">";
                echo ($context["OA_SOCIAL_LOGIN_PAGE_CAPTION"] ?? null);
                echo "</h2>
\t\t\t\t";
            }
            // line 8
            echo "\t\t\t\t<div class=\"oneall_social_login_providers\" id=\"oneall_social_login_overall_header_content_before\"></div>
\t\t\t\t\t<!-- OneAll Social Login : http://www.oneall.com //-->
\t\t\t\t\t<script type=\"text/javascript\">
\t\t\t\t\t\t// <![CDATA[\t\t\t\t\t            
\t\t\t\t\t\t\tvar _oneall = _oneall || [];
\t\t\t\t\t\t\t_oneall.push(['social_login', 'set_providers', ['";
            // line 13
            echo ($context["OA_SOCIAL_LOGIN_PROVIDERS"] ?? null);
            echo "']]);\t
\t\t\t\t\t\t\t_oneall.push(['social_login', 'set_callback_uri', '";
            // line 14
            echo ($context["OA_SOCIAL_LOGIN_CALLBACK_URI"] ?? null);
            echo "']);\t\t\t\t
\t\t\t\t\t\t\t_oneall.push(['social_login', 'set_custom_css_uri', ((\"https:\" == document.location.protocol) ? \"https://secure\" : \"http://public\") + '.oneallcdn.com/css/api/socialize/themes/phpbb/default.css']);
\t\t\t\t\t\t\t_oneall.push(['social_login', 'do_render_ui', 'oneall_social_login_overall_header_content_before']);
\t\t\t\t\t\t// ]]>
\t\t\t\t\t</script>\t\t
\t\t\t</div>
\t\t</div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "@oneall_sociallogin/event/overall_header_content_before.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 14,  41 => 13,  34 => 8,  28 => 6,  26 => 5,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@oneall_sociallogin/event/overall_header_content_before.html", "");
    }
}
