<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{base_url()}">
    <meta charset="utf-8">
    <title>{$meta.title|default:$site.title}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {if $meta.description}
    <meta name="description" content="{$meta.description}">
    {/if}

    {css('pledgestarter.css')}

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    {js('jquery.min.js')}

</head>

<body>

    <header>
        {block name=header}{/block}
    </header>

    {block name=main}{/block}

{js('pledgestarter.js')}

</body>
</html>
