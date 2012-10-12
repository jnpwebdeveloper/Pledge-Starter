{extends file="layout.main.tpl"}

	{block name=header}
		<div id="header">
			{if $project}
				<h1>{$project->name}</h1>
				<h2>by Acme Company</h2>
			{else}
				<h1>Project does not exist</h1>
				<h2>Sorry, project does not exist</h2>
			{/if}
		</div>
	{/block}

	{block name=main}
		<section id="project">
			<article>
				<section id="project-image">{img file="project-image.jpg"}</section>
				<section id="project-pullout">{$project->short_description}</section>
				<section id="project-meta">Launched: {mysqldatetime_to_date($project->start_date, 'd M, Y')} &mdash; {mysqldatetime_to_date($project->end_date, 'd M, Y')}</section>
				<section id="project-description">{$project->long_description}</section>
			</article>
			<aside>
				<section id="project-analytics">
					<section>
						<span class="numeric">250</span>
						<span class="label">backers</span>
					</section>
					<section>
						<span class="numeric">$250, 000</span>
						<span class="label">pledged of $1,000,000</span>
					</section>
					<section>
						<span class="numeric">3</span>
						<span class="label">days left</span>
						<span class="note">roughly $83, 300 needed per day</span>
					</section>					
				</section>
				<section id="project-button">
					<a href="javascript:void(0);">Pledge<span>$1 minimum pledge</span></a>
				</section>
			</aside>
		</section>
	{/block}