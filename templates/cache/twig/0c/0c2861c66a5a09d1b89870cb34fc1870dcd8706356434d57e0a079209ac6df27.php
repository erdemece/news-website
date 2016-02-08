<?php

/* index.twig */
class __TwigTemplate_cea93ca96f02bfe34247ea9a5172421c81fe1d8ff41ee2b56296c0f8a3384c06 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Image Upload</title>

    <!-- Bootstrap -->
    <link href=\"/skin/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"/skin/css/bootstrap-theme.css\" rel=\"stylesheet\">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
      <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
  </head>
  <body>
    <div class=\"container\">
          <div class=\"panel panel-default\">
            <div class=\"panel-heading\"><h4>Fotoğraf Yüklemece</h4></div>
            <div class=\"panel-body\">
              ";
        // line 25
        if ( !twig_test_empty($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "danger", array()))) {
            // line 26
            echo "              <div class=\"col-xs-12 col-sm-12 col-md-12\">
                <div class=\"alert alert-danger alert-dismissible fade in\" role=\"alert\">
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button>
                  <h4>Hata...</h4>
                  ";
            // line 30
            if (twig_test_iterable($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "danger", array()))) {
                // line 31
                echo "                    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "danger", array()));
                foreach ($context['_seq'] as $context["key"] => $context["error"]) {
                    // line 32
                    echo "                    ";
                    echo twig_escape_filter($this->env, $context["error"], "html", null, true);
                    echo " <br />
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 34
                echo "                  ";
            } else {
                // line 35
                echo "                     ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["flash"]) ? $context["flash"] : null), "danger", array()), "html", null, true);
                echo "
                  ";
            }
            // line 37
            echo "                </div>
              </div>
              ";
        }
        // line 40
        echo "              <!-- Standar Form -->

              <form action=\"\\upload\" method=\"post\" enctype=\"multipart/form-data\">
                <div class=\"form-group\">
                  <label for=\"exampleInputFile\">Foto Seç</label>
                  <input type=\"file\" name=\"image\">
                </div>
                <div class=\"form-group\">
                  <div class=\"col-sm-12\">
                   <label for=\"imageOne\" class=\"col-sm-2 control-label\">Fotograf 1:</label>
                   <div class=\"col-sm-2\">
                     <input type=\"text\" class=\"form-control\" name=\"imageOneWidht\" placeholder=\"Width\" required=\"\">
                   </div>
                   <div class=\"col-sm-2\">
                     <input type=\"text\" class=\"form-control\" name=\"imageOneHeight\" placeholder=\"Height\" required=\"\">
                   </div>
                 </div>
                </div>
                <div class=\"form-group\">
                  <div class=\"col-sm-12\">
                   <label for=\"imageOne\" class=\"col-sm-2 control-label\">Fotograf 2:</label>
                   <div class=\"col-sm-2\">
                     <input type=\"text\" class=\"form-control\" name=\"imageTwoWidht\" placeholder=\"Width\" required=\"\">
                   </div>
                   <div class=\"col-sm-2\">
                     <input type=\"text\" class=\"form-control\" name=\"imageTwoHeight\" placeholder=\"Height\" required=\"\">
                   </div>
                 </div>
                </div>
                <div class=\"form-group\">
                  <div class=\"col-sm-12\">
                    <button type=\"submit\" class=\"btn btn-sm btn-primary\">Upload files</button>
                  </div>
                </div>
              </form>
              <div class=\"row\">
              ";
        // line 76
        if ( !twig_test_empty((isset($context["image1"]) ? $context["image1"] : null))) {
            // line 77
            echo "              <div class=\"col-xs-6 col-md-3\">
                <strong>";
            // line 78
            echo twig_escape_filter($this->env, (isset($context["image1"]) ? $context["image1"] : null), "html", null, true);
            echo "</strong>
                <a href=\"";
            // line 79
            echo twig_escape_filter($this->env, (isset($context["image1"]) ? $context["image1"] : null), "html", null, true);
            echo "\" target=\"_blank\" class=\"thumbnail\">
                  <img src=\"";
            // line 80
            echo twig_escape_filter($this->env, (isset($context["image1"]) ? $context["image1"] : null), "html", null, true);
            echo "\" alt=\"...\">
                </a>
              </div>
              ";
        }
        // line 84
        echo "              ";
        if ( !twig_test_empty((isset($context["image2"]) ? $context["image2"] : null))) {
            // line 85
            echo "              <div class=\"col-xs-6 col-md-3\">
                <strong>";
            // line 86
            echo twig_escape_filter($this->env, (isset($context["image2"]) ? $context["image2"] : null), "html", null, true);
            echo "</strong>
                <a href=\"";
            // line 87
            echo twig_escape_filter($this->env, (isset($context["image2"]) ? $context["image2"] : null), "html", null, true);
            echo "\" target=\"_blank\" class=\"thumbnail\">
                  <img src=\"";
            // line 88
            echo twig_escape_filter($this->env, (isset($context["image2"]) ? $context["image2"] : null), "html", null, true);
            echo "\" alt=\"...\">
                </a>
              </div>
              ";
        }
        // line 92
        echo "            </div>
            </div>
          </div>
        </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js\"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=\"/skin/js/bootstrap.min.js\"></script>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 92,  155 => 88,  151 => 87,  147 => 86,  144 => 85,  141 => 84,  134 => 80,  130 => 79,  126 => 78,  123 => 77,  121 => 76,  83 => 40,  78 => 37,  72 => 35,  69 => 34,  60 => 32,  55 => 31,  53 => 30,  47 => 26,  45 => 25,  19 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="en">*/
/*   <head>*/
/*     <meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*     <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->*/
/*     <title>Image Upload</title>*/
/* */
/*     <!-- Bootstrap -->*/
/*     <link href="/skin/css/bootstrap.min.css" rel="stylesheet">*/
/*     <link href="/skin/css/bootstrap-theme.css" rel="stylesheet">*/
/*     <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->*/
/*     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*     <!--[if lt IE 9]>*/
/*       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>*/
/*       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>*/
/*     <![endif]-->*/
/*   </head>*/
/*   <body>*/
/*     <div class="container">*/
/*           <div class="panel panel-default">*/
/*             <div class="panel-heading"><h4>Fotoğraf Yüklemece</h4></div>*/
/*             <div class="panel-body">*/
/*               {% if flash.danger is not empty  %}*/
/*               <div class="col-xs-12 col-sm-12 col-md-12">*/
/*                 <div class="alert alert-danger alert-dismissible fade in" role="alert">*/
/*                   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>*/
/*                   <h4>Hata...</h4>*/
/*                   {% if flash.danger is iterable %}*/
/*                     {% for key,  error in flash.danger %}*/
/*                     {{ error }} <br />*/
/*                     {% endfor %}*/
/*                   {% else %}*/
/*                      {{ flash.danger }}*/
/*                   {% endif %}*/
/*                 </div>*/
/*               </div>*/
/*               {% endif %}*/
/*               <!-- Standar Form -->*/
/* */
/*               <form action="\upload" method="post" enctype="multipart/form-data">*/
/*                 <div class="form-group">*/
/*                   <label for="exampleInputFile">Foto Seç</label>*/
/*                   <input type="file" name="image">*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                   <div class="col-sm-12">*/
/*                    <label for="imageOne" class="col-sm-2 control-label">Fotograf 1:</label>*/
/*                    <div class="col-sm-2">*/
/*                      <input type="text" class="form-control" name="imageOneWidht" placeholder="Width" required="">*/
/*                    </div>*/
/*                    <div class="col-sm-2">*/
/*                      <input type="text" class="form-control" name="imageOneHeight" placeholder="Height" required="">*/
/*                    </div>*/
/*                  </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                   <div class="col-sm-12">*/
/*                    <label for="imageOne" class="col-sm-2 control-label">Fotograf 2:</label>*/
/*                    <div class="col-sm-2">*/
/*                      <input type="text" class="form-control" name="imageTwoWidht" placeholder="Width" required="">*/
/*                    </div>*/
/*                    <div class="col-sm-2">*/
/*                      <input type="text" class="form-control" name="imageTwoHeight" placeholder="Height" required="">*/
/*                    </div>*/
/*                  </div>*/
/*                 </div>*/
/*                 <div class="form-group">*/
/*                   <div class="col-sm-12">*/
/*                     <button type="submit" class="btn btn-sm btn-primary">Upload files</button>*/
/*                   </div>*/
/*                 </div>*/
/*               </form>*/
/*               <div class="row">*/
/*               {% if image1 is not empty %}*/
/*               <div class="col-xs-6 col-md-3">*/
/*                 <strong>{{image1}}</strong>*/
/*                 <a href="{{image1}}" target="_blank" class="thumbnail">*/
/*                   <img src="{{image1}}" alt="...">*/
/*                 </a>*/
/*               </div>*/
/*               {% endif %}*/
/*               {% if image2 is not empty %}*/
/*               <div class="col-xs-6 col-md-3">*/
/*                 <strong>{{image2}}</strong>*/
/*                 <a href="{{image2}}" target="_blank" class="thumbnail">*/
/*                   <img src="{{image2}}" alt="...">*/
/*                 </a>*/
/*               </div>*/
/*               {% endif %}*/
/*             </div>*/
/*             </div>*/
/*           </div>*/
/*         </div> <!-- /container -->*/
/* */
/*     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->*/
/*     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>*/
/*     <!-- Include all compiled plugins (below), or include individual files as needed -->*/
/*     <script src="/skin/js/bootstrap.min.js"></script>*/
/*   </body>*/
/* </html>*/
/* */
