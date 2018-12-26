<?php

/* ucp_login_link.html */
class __TwigTemplate_86b868447858ddb8737dd073739f1ff3518912e0f78797c52ae55069e70dcd3a extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "ucp_login_link.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<div class=\"panel\">
\t<div class=\"inner\">

\t<h2>";
        // line 6
        echo ($context["SITENAME"] ?? null);
        echo " - ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LOGIN_LINK");
        echo "</h2>

\t<p>";
        // line 8
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LOGIN_LINK_EXPLAIN");
        echo "</p>

\t";
        // line 10
        if (($context["LOGIN_LINK_ERROR"] ?? null)) {
            echo "<div class=\"content\">
\t\t<div class=\"error\">";
            // line 11
            echo ($context["LOGIN_LINK_ERROR"] ?? null);
            echo "</div>
\t</div>";
        }
        // line 13
        echo "
\t<div class=\"content\">
\t\t<h2>";
        // line 15
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REGISTER");
        echo "</h2>

\t\t<form action=\"";
        // line 17
        echo ($context["REGISTER_ACTION"] ?? null);
        echo "\" method=\"post\" id=\"register\">
\t\t\t<fieldset class=\"fields1\">
\t\t\t\t<dl>
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd>";
        // line 21
        echo ($context["S_HIDDEN_FIELDS"] ?? null);
        echo "<input type=\"submit\" name=\"register\" tabindex=\"1\" value=\"";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REGISTER");
        echo "\" class=\"button1\" /></dd>
\t\t\t\t</dl>
\t\t\t</fieldset>
\t\t</form>
\t</div>

\t<div class=\"content\">
\t\t<h2>";
        // line 28
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LOGIN");
        echo "</h2>

\t\t<form action=\"";
        // line 30
        echo ($context["LOGIN_ACTION"] ?? null);
        echo "\" method=\"post\" id=\"login\">
\t\t\t<fieldset class=\"fields1\">
\t\t\t\t";
        // line 32
        if (($context["LOGIN_ERROR"] ?? null)) {
            echo "<div class=\"error\">";
            echo ($context["LOGIN_ERROR"] ?? null);
            echo "</div>";
        }
        // line 33
        echo "\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"";
        // line 34
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\">";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERNAME");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t\t\t\t\t<dd><input type=\"text\" tabindex=\"2\" name=\"";
        // line 35
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\" id=\"";
        echo ($context["USERNAME_CREDENTIAL"] ?? null);
        echo "\" size=\"25\" value=\"";
        echo ($context["LOGIN_USERNAME"] ?? null);
        echo "\" class=\"inputbox autowidth\" /></dd>
\t\t\t\t</dl>
\t\t\t\t<dl>
\t\t\t\t\t<dt><label for=\"";
        // line 38
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\">";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PASSWORD");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t\t\t\t\t<dd><input type=\"password\" tabindex=\"3\" id=\"";
        // line 39
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\" name=\"";
        echo ($context["PASSWORD_CREDENTIAL"] ?? null);
        echo "\" size=\"25\" class=\"inputbox autowidth\" autocomplete=\"off\" /></dd>
\t\t\t\t</dl>
\t\t\t\t";
        // line 41
        if ((($context["CAPTCHA_TEMPLATE"] ?? null) && ($context["S_CONFIRM_CODE"] ?? null))) {
            // line 42
            echo "\t\t\t\t\t";
            $value = 4;
            $context['definition']->set('CAPTCHA_TAB_INDEX', $value);
            // line 43
            echo "\t\t\t\t\t";
            $location = (("" . ($context["CAPTCHA_TEMPLATE"] ?? null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . ($context["CAPTCHA_TEMPLATE"] ?? null)) . ""), "ucp_login_link.html", 43)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 44
            echo "\t\t\t\t";
        }
        // line 45
        echo "
\t\t\t\t";
        // line 46
        echo ($context["S_LOGIN_REDIRECT"] ?? null);
        echo "
\t\t\t\t<dl>
\t\t\t\t\t<dt>&nbsp;</dt>
\t\t\t\t\t<dd>";
        // line 49
        echo ($context["S_HIDDEN_FIELDS"] ?? null);
        echo "<input type=\"submit\" name=\"login\" tabindex=\"5\" value=\"";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LOGIN");
        echo "\" class=\"button1\" /></dd>
\t\t\t\t</dl>
\t\t\t</fieldset>
\t\t</form>
\t</div>

\t</div>
</div>

";
        // line 58
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "ucp_login_link.html", 58)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_login_link.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  181 => 58,  167 => 49,  161 => 46,  158 => 45,  155 => 44,  142 => 43,  138 => 42,  136 => 41,  129 => 39,  122 => 38,  112 => 35,  105 => 34,  102 => 33,  96 => 32,  91 => 30,  86 => 28,  74 => 21,  67 => 17,  62 => 15,  58 => 13,  53 => 11,  49 => 10,  44 => 8,  37 => 6,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ucp_login_link.html", "");
    }
}
