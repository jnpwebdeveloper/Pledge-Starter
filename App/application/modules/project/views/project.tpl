{extends file="layout.main.tpl"}

{block name=header}
	<div id="header">
		<h1>Some Test Headline</h1>
		<h2>by Acme Company</h2>
	</div>
{/block}

{block name=main}
	<section id="project">
		<article>
			<section id="project-image">{img file="project-image.jpg"}</section>
			<section id="project-pullout"><p>An immersive web 2.0, CSS3, HTML5 Javascript object literal syntax cancer curing device.</p></section>
			<section id="project-meta">Launched: 22 September, 2012 &mdash; Ends: 1 November, 2012</section>
			<section id="project-description">
				<p>With your pledge, the Eastern Addition will produce a dinner series that will explore a different regional Asian specialty each month. Chef Tim Luym will curate a roster of unsung and overlooked heroes to guide the eater through a culinary tour.  The Eastern Addition will begin on October 17, 2012, at Vinyl Cafe in the Western Addition and will meet every Wednesday for 3 months.</p>
			</section>
		</article>
		<aside></aside>
	</section>
{/block}