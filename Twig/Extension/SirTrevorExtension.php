<?php

namespace Cas\SirTrevorBundle\Twig\Extension;

class SirTrevorExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    public function getGlobals()
    {
        return array();
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('render_sir_trevor', array(
                $this,
                'renderSirTrevor'
            ), array('is_safe' => array('html'),
                'needs_environment' => true)
            ),
        );
    }

    public function renderSirTrevor(\Twig_Environment $twig, $data)
    {
        $markup = '';
        $data = json_decode($data);
        foreach ($data->data as $block) {
            $template = "CasSirTrevorBundle:SirTrevor:{$block->type}.html.twig";
            $markup .= $twig->render($template, [
                'content' => $block->data,
            ]);
        }

        return $markup;
    }

    public function getName()
    {
        return 'sir_trevor';
    }
}
