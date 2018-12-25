<?php

/* test.txt */
class __TwigTemplate_da70b147ef2aeb0c4228c809a030f96e4d1f7f2f85948ddaf72287b4e58af93a extends Twig_Template
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
        echo "Subject: phpBB je na posielanie emailov nastavené správne

Dobrý deň ";
        // line 3
        echo ($context["USERNAME"] ?? null);
        echo ",

Gratulujeme. Ak ste dostali tento email, phpBB je na posielanie emailov nastavené správne.

V prípade, že potrebujete pomoc, prosíme, navštívte phpBB fóra podpory - https://www.phpbb.com/community/ (v Angličtine)

";
        // line 9
        echo ($context["EMAIL_SIG"] ?? null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "test.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 9,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "test.txt", "");
    }
}
