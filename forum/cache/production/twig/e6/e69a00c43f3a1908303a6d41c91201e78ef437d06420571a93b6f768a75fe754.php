<?php

/* @vinny_rememberme/event/overall_footer_after.html */
class __TwigTemplate_f55a11a985eb995117b2aa4de26e2cc2115d7038c36f0d81b7c0f4ce02b0537c extends Twig_Template
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
        if (( !($context["S_USER_LOGGED_IN"] ?? null) &&  !($context["S_IS_BOT"] ?? null))) {
            // line 2
            echo "<script>
\$(document).ready(function(){
\t\$(\"#autologin\").prop(
\t\t\"checked\", true
\t);
});
</script>
";
        }
    }

    public function getTemplateName()
    {
        return "@vinny_rememberme/event/overall_footer_after.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@vinny_rememberme/event/overall_footer_after.html", "");
    }
}
