<div class="bb-custom-wrapper" style="width: 1276px; height: 360px;">
	<div id="bb-bookblock" class="bb-bookblock" style="perspective: 2000px; width: 1276px; height: 360px;">
			<div class="bb-item" id="item1" style="display: none;">
				<div class="book-content">
					<div class="scroller">
						<h1 class="chapter-heading">Chapter 1</h1><p>Text Chapter 1<br>
						a<br>
						dfa<br>
						sfa<br>
						sf<br>
						a<br>

						sf<br>
						as<br>
						fas</p>
					</div>
				</div>
			</div><!-- end bb-item -->
			<div class="bb-item" id="item2" style="display: block;">
				<div class="book-content jspScrollable" tabindex="0" style="overflow: hidden; padding: 0px; width: 1276px; outline: none;">
					
					<div class="jspContainer" style="width: 1276px; height: 250px;">
							<div class="jspPane" style="padding: 0px; width: 1267px; top: -144px;">
								<div class="scroller">
									<h1 class="chapter-heading">chap 2</h1>
									<?php
										echo pb_tag_subsections( apply_filters( 'the_content', get_the_content() ), $post->page["ID"]);

									?>
							</div>
						</div>
						<div class="jspVerticalBar">
							<div class="jspCap jspCapTop"></div>
								<div class="jspTrack" style="height: 170px;">
									<div class="jspDrag" style="height: 51px; top: 27.5261px;">
										<div class="jspDragTop"></div>
										<div class="jspDragBottom"></div>
									</div>
								</div>
							<div class="jspCap jspCapBottom"></div>
						</div>
				</div>
			</div>
		</div><!-- end bb-item -->
	</div>

	<nav>
		<span id="bb-nav-prev" style="display: block;">←</span>
		<span id="bb-nav-next" style="display: none;">→</span>
	</nav>

	<span id="tblcontents" class="menu-button">Table of Contents</span>

	<span class="bb-nav-close"><i class="fa fa-times"></i></span>

</div>