<?php

/* @oneall_sociallogin/event/overall_header_stylesheets_after.html */
class __TwigTemplate_00df914661fee473664b43874bd0445c7428e4204cf3c6f28703d5a9dd10e539 extends Twig_Template
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
        if (($context["OA_SOCIAL_LOGIN_EMBED_LIBRARY"] ?? null)) {
            echo " 
\t\t<!-- OneAll Social Login : http://www.oneall.com //-->
\t\t<script type=\"text/javascript\">
\t\t\t// <![CDATA[\t\t
\t\t\t\t(function () {
\t\t\t\t\tvar oa = document.createElement('script'); oa.type = 'text/javascript'; 
\t\t\t\t\toa.async = true; oa.src = '//";
            // line 7
            echo ($context["OA_SOCIAL_LOGIN_API_SUBDOMAIN"] ?? null);
            echo ".api.oneall.com/socialize/library.js';
\t\t\t\t\tvar s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(oa, s);
\t\t\t\t})();
\t\t\t// ]]>
\t\t</script>
";
        }
    }

    public function getTemplateName()
    {
        return "@oneall_sociallogin/event/overall_header_stylesheets_after.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 7,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@oneall_sociallogin/event/overall_header_stylesheets_after.html", "");
    }
}
