<?php

/* login_body_oauth.html */
class __TwigTemplate_2c42b0677e460c4ad84d1bf6ca8d95e87dd77e6da4c08736a348e20e570acb14 extends Twig_Template
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
        echo "<div class=\"content\">
\t";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "oauth", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["oauth"]) {
            // line 3
            echo "\t<dl>
\t\t<dt>&nbsp;</dt>
\t\t<dd><a href=\"";
            // line 5
            echo $this->getAttribute($context["oauth"], "REDIRECT_URL", array());
            echo "\" class=\"button2\">";
            echo $this->getAttribute($context["oauth"], "SERVICE_NAME", array());
            echo "</a></dd>
\t</dl>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['oauth'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 8
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "login_body_oauth.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 8,  30 => 5,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "login_body_oauth.html", "");
    }
}
