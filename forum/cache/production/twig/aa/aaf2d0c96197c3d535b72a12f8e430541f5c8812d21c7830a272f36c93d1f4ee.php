<?php

/* posting_topic_review.html */
class __TwigTemplate_18e8b6526341cd197ddbb2994c4ed5eeb080b99193b408b31dc97271c3595667 extends Twig_Template
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
        echo "
<h3 id=\"review\" class=\"review\">
\t<span class=\"right-box\"><a href=\"#review\" onclick=\"viewableArea(getElementById('topicreview'), true); var rev_text = getElementById('review').getElementsByTagName('a').item(0).firstChild; if (rev_text.data == '";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('phpbb\template\twig\extension')->lang("EXPAND_VIEW"), "js");
        echo "'){rev_text.data = '";
        echo twig_escape_filter($this->env, $this->env->getExtension('phpbb\template\twig\extension')->lang("COLLAPSE_VIEW"), "js");
        echo "'; } else if (rev_text.data == '";
        echo twig_escape_filter($this->env, $this->env->getExtension('phpbb\template\twig\extension')->lang("COLLAPSE_VIEW"), "js");
        echo "'){rev_text.data = '";
        echo twig_escape_filter($this->env, $this->env->getExtension('phpbb\template\twig\extension')->lang("EXPAND_VIEW"), "js");
        echo "'};\">";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXPAND_VIEW");
        echo "</a></span>
\t";
        // line 4
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOPIC_REVIEW");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo " ";
        echo ($context["TOPIC_TITLE"] ?? null);
        echo "
</h3>

<div id=\"topicreview\" class=\"topicreview\">
<script>
\tbbcodeEnabled = ";
        // line 9
        echo ($context["S_BBCODE_ALLOWED"] ?? null);
        echo ";
</script>
\t";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["loops"] ?? null), "topic_review_row", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["topic_review_row"]) {
            // line 12
            echo "
\t";
            // line 13
            if ($this->getAttribute($context["topic_review_row"], "S_IGNORE_POST", array())) {
                // line 14
                echo "\t<div class=\"post bg3 post-ignore\">
\t\t<div class=\"inner\">
\t\t\t";
                // line 16
                echo $this->getAttribute($context["topic_review_row"], "L_IGNORE_POST", array());
                echo "
\t";
            } elseif ($this->getAttribute(            // line 17
$context["topic_review_row"], "S_POST_DELETED", array())) {
                // line 18
                echo "\t<div class=\"post bg3 post-ignore\">
\t\t<div class=\"inner\">
\t\t\t";
                // line 20
                echo $this->getAttribute($context["topic_review_row"], "L_DELETE_POST", array());
                echo "
\t";
            } else {
                // line 22
                echo "\t<div class=\"post ";
                if (($this->getAttribute($context["topic_review_row"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo "bg1";
                } else {
                    echo "bg2";
                }
                if (($this->getAttribute($context["topic_review_row"], "POST_ID", array()) == ($context["REPORTED_POST_ID"] ?? null))) {
                    echo " reported";
                }
                echo "\">
\t\t<div class=\"inner\">
\t";
            }
            // line 25
            echo "
\t\t<div class=\"postbody\" id=\"pr";
            // line 26
            echo $this->getAttribute($context["topic_review_row"], "POST_ID", array());
            echo "\">
\t\t\t<h3><a href=\"#pr";
            // line 27
            echo $this->getAttribute($context["topic_review_row"], "POST_ID", array());
            echo "\">";
            echo $this->getAttribute($context["topic_review_row"], "POST_SUBJECT", array());
            echo "</a></h3>

\t\t\t";
            // line 29
            if ((($this->getAttribute($context["topic_review_row"], "POSTER_QUOTE", array()) && $this->getAttribute($context["topic_review_row"], "DECODED_MESSAGE", array())) || $this->getAttribute($context["topic_review_row"], "U_MCP_DETAILS", array()))) {
                // line 30
                echo "\t\t\t<ul class=\"post-buttons\">
\t\t\t";
                // line 31
                if ($this->getAttribute($context["topic_review_row"], "U_MCP_DETAILS", array())) {
                    // line 32
                    echo "\t\t\t\t<li>
\t\t\t\t\t<a href=\"";
                    // line 33
                    echo $this->getAttribute($context["topic_review_row"], "U_MCP_DETAILS", array());
                    echo "\" title=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_DETAILS");
                    echo "\" class=\"button button-icon-only\">
\t\t\t\t\t\t<i class=\"icon fa-info fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 34
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_DETAILS");
                    echo "</span>
\t\t\t\t\t</a>
\t\t\t\t<li>
\t\t\t";
                }
                // line 38
                echo "\t\t\t";
                if (($this->getAttribute($context["topic_review_row"], "POSTER_QUOTE", array()) && $this->getAttribute($context["topic_review_row"], "DECODED_MESSAGE", array()))) {
                    // line 39
                    echo "\t\t\t\t<li>
\t\t\t\t\t<a href=\"#postingbox\" onclick=\"addquote(";
                    // line 40
                    echo $this->getAttribute($context["topic_review_row"], "POST_ID", array());
                    echo ", '";
                    echo $this->getAttribute($context["topic_review_row"], "POSTER_QUOTE", array());
                    echo "', '";
                    echo twig_escape_filter($this->env, $this->env->getExtension('phpbb\template\twig\extension')->lang("WROTE"), "js");
                    echo "', {post_id:";
                    echo $this->getAttribute($context["topic_review_row"], "POST_ID", array());
                    echo ",time:";
                    echo $this->getAttribute($context["topic_review_row"], "POST_TIME", array());
                    echo ",user_id:";
                    echo $this->getAttribute($context["topic_review_row"], "USER_ID", array());
                    echo "});\" title=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUOTE");
                    echo " ";
                    echo $this->getAttribute($context["topic_review_row"], "POST_AUTHOR", array());
                    echo "\" class=\"button button-icon-only\">
\t\t\t\t\t\t<i class=\"icon fa-quote-left fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                    // line 41
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUOTE");
                    echo " ";
                    echo $this->getAttribute($context["topic_review_row"], "POST_AUTHOR", array());
                    echo "</span>
\t\t\t\t\t</a>
\t\t\t\t</li>
\t\t\t";
                }
                // line 45
                echo "\t\t\t</ul>
\t\t\t";
            }
            // line 47
            echo "
\t\t\t";
            // line 48
            // line 49
            echo "\t\t\t<p class=\"author\">
\t\t\t\t";
            // line 50
            if (($context["S_IS_BOT"] ?? null)) {
                // line 51
                echo "\t\t\t\t\t<span><i class=\"icon fa-file fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                echo $this->getAttribute($context["topic_review_row"], "MINI_POST", array());
                echo "</span></span>
\t\t\t\t";
            } else {
                // line 53
                echo "\t\t\t\t\t<a href=\"";
                echo $this->getAttribute($context["topic_review_row"], "U_MINI_POST", array());
                echo "\" title=\"";
                echo $this->getAttribute($context["topic_review_row"], "MINI_POST", array());
                echo "\">
\t\t\t\t\t\t<i class=\"icon fa-file fa-fw icon-lightgray icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 54
                echo $this->getAttribute($context["topic_review_row"], "MINI_POST", array());
                echo "</span>
\t\t\t\t\t</a>
\t\t\t\t";
            }
            // line 57
            echo "\t\t\t\t";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_BY_AUTHOR");
            echo " <strong>";
            echo $this->getAttribute($context["topic_review_row"], "POST_AUTHOR_FULL", array());
            echo "</strong> &raquo; ";
            echo $this->getAttribute($context["topic_review_row"], "POST_DATE", array());
            echo "
\t\t\t</p>
\t\t\t";
            // line 59
            // line 60
            echo "
\t\t\t<div class=\"content\">";
            // line 61
            echo $this->getAttribute($context["topic_review_row"], "MESSAGE", array());
            echo "</div>

\t\t\t";
            // line 63
            // line 64
            echo "
\t\t\t";
            // line 65
            if ($this->getAttribute($context["topic_review_row"], "S_HAS_ATTACHMENTS", array())) {
                // line 66
                echo "\t\t\t\t<dl class=\"attachbox\">
\t\t\t\t\t<dt>";
                // line 67
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ATTACHMENTS");
                echo "</dt>
\t\t\t\t\t";
                // line 68
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["topic_review_row"], "attachment", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 69
                    echo "\t\t\t\t\t\t<dd>";
                    echo $this->getAttribute($context["attachment"], "DISPLAY_ATTACHMENT", array());
                    echo "</dd>
\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 71
                echo "\t\t\t\t</dl>
\t\t\t";
            }
            // line 73
            echo "
\t\t\t";
            // line 74
            if (($this->getAttribute($context["topic_review_row"], "POSTER_QUOTE", array()) && $this->getAttribute($context["topic_review_row"], "DECODED_MESSAGE", array()))) {
                // line 75
                echo "\t\t\t\t<div id=\"message_";
                echo $this->getAttribute($context["topic_review_row"], "POST_ID", array());
                echo "\" style=\"display: none;\">";
                echo $this->getAttribute($context["topic_review_row"], "DECODED_MESSAGE", array());
                echo "</div>
\t\t\t";
            }
            // line 77
            echo "\t\t</div>
\t\t</div>
\t</div>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['topic_review_row'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 81
        echo "</div>

<hr />

<p>
\t<a href=\"";
        // line 86
        if (($context["S_MCP_REPORT"] ?? null)) {
            echo "#report";
        } else {
            echo "#postingbox";
        }
        echo "\" class=\"top\">
\t\t<i class=\"icon fa-chevron-circle-up fa-fw icon-gray\" aria-hidden=\"true\"></i><span>";
        // line 87
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK_TO_TOP");
        echo "</span>
\t</a>
</p>
";
    }

    public function getTemplateName()
    {
        return "posting_topic_review.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  281 => 87,  273 => 86,  266 => 81,  257 => 77,  249 => 75,  247 => 74,  244 => 73,  240 => 71,  231 => 69,  227 => 68,  223 => 67,  220 => 66,  218 => 65,  215 => 64,  214 => 63,  209 => 61,  206 => 60,  205 => 59,  195 => 57,  189 => 54,  182 => 53,  176 => 51,  174 => 50,  171 => 49,  170 => 48,  167 => 47,  163 => 45,  154 => 41,  136 => 40,  133 => 39,  130 => 38,  123 => 34,  117 => 33,  114 => 32,  112 => 31,  109 => 30,  107 => 29,  100 => 27,  96 => 26,  93 => 25,  79 => 22,  74 => 20,  70 => 18,  68 => 17,  64 => 16,  60 => 14,  58 => 13,  55 => 12,  51 => 11,  46 => 9,  35 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "posting_topic_review.html", "");
    }
}
