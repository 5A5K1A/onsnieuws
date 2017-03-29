<?php
/**
 * @package WordPress
 * @subpackage ChildTheme
 */

	get_header();
?>
		<main class="articles">
			<article>
				<h1>Oops! Deze pagina is niet gevonden</h1>
				<p>
					Er ging wat mis! De pagina waar u naar op zoek was, werd niet gevonden.
				</p>
				<h3>Wat ging er mis?</h3>
				<p>
					De pagina die u zocht, bestaat niet (meer) of is verhuisd naar een andere locatie.
				</p>
				<h3>Wat kunt u nu doen?</h3>
				<ul>
					<li>Controleer het ingegeven webadres;</li>
					<li>Kijk eens in de sitemap, onderaan deze pagina;</li>
					<li>Gebruik onze zoekbalk.</li>
				</ul>
				<?php get_search_form(); ?>
			</article>
		</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
