<?php
/**
 * Projects Section Template Part - Exact copy from original static site
 * NOTE: Original has TWO separate projects sections
 */
?>

<!-- First Projects Section: "Some of my Recent Projects" -->
<section class="projects">
    <div class="anchor-projects" id="projects"></div>
    <div class="project-inner">
        <h2 class="project-title fz24">
            Some of my Recent Projects
        </h2>
        <ul class="card-list">
            <?php
            // Query for recent project posts (first 3)
            $recent_projects_query = new WP_Query(array(
                'post_type' => 'project',
                'posts_per_page' => 3,
                'post_status' => 'publish',
                'meta_key' => 'project_section',
                'meta_value' => 'recent'
            ));

            if ($recent_projects_query->have_posts()) :
                while ($recent_projects_query->have_posts()) : $recent_projects_query->the_post();
                    $project_url = get_post_meta(get_the_ID(), 'project_url', true);
                    ?>
                    <li class="card-item">
                        <a href="<?php echo esc_url($project_url); ?>" class="card-block project-card-fadein" target="_blank">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'project-pic', 'loading' => 'lazy')); ?>
                            <?php endif; ?>
                            <h3 class="project-title">
                                <?php the_title(); ?>
                            </h3>
                            <p class="project-details">
                                <?php the_excerpt(); ?>
                            </p>
                            <p class="project-text">
                                Check it Out
                            </p>
                        </a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default recent projects if none are added yet
                ?>
                <li class="card-item">
                    <a href="https://rikiya-okawa-369.vercel.app/jp" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/new-portfolio.jpg" alt="project03.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            ポートフォリオサイト
                        </h3>
                        <p class="project-details">
                            React、TypeScript、Three.js、Next.jsを学ぶために制作したポートフォリオサイトです。テクノロジーとデザインの融合を意識し、没入感のあるインターフェースを追求しました。モダンな技術とクリエイティブな表現力の向上を目指しています。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works03.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/project03.jpg" alt="project03.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            グッゲンハイム x ggg Webデザイン
                        </h3>
                        <p class="project-details">
                            UI/UXクラスでAdobe XDを使用し、架空の美術展覧会サイトを制作しました。ユーザーフレンドリーなデザインとインタラクティブな要素に重点を置き、約3時間で完成。ウェブデザインスキル向上に大きく貢献したプロジェクトです。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works01.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/girardians.jpg" alt="GUARDIANS_logo" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            GUARDIANS OF THE MOON
                        </h3>
                        <p class="project-details">
                            卒業制作で、実在するVR・AR施設のサービス改善に向け、UnityとTouchDesignerを使用してVRゲームとインタラクティブ映像を制作しました。ゲーム制作に約1ヶ月、映像制作に約1週間をかけ、C#やアセットストア素材を活用しました。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <?php
            endif;
            ?>
        </ul>
    </div>
</section>

<!-- Second Projects Section: "My Projects" -->
<section class="projects">
    <div class="project-inner">
        <h2 class="project-title fz24">
            My Projects
        </h2>
        <ul class="card-list">
            <?php
            // Query for all other projects
            $all_projects_query = new WP_Query(array(
                'post_type' => 'project',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_key' => 'project_section',
                'meta_value' => 'all'
            ));

            if ($all_projects_query->have_posts()) :
                while ($all_projects_query->have_posts()) : $all_projects_query->the_post();
                    $project_url = get_post_meta(get_the_ID(), 'project_url', true);
                    ?>
                    <li class="card-item">
                        <a href="<?php echo esc_url($project_url); ?>" class="card-block project-card-fadein" target="_blank">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'project-pic', 'loading' => 'lazy')); ?>
                            <?php endif; ?>
                            <h3 class="project-title <?php echo (strpos(get_the_title(), 'カヤック') !== false) ? 'fz18' : ''; ?>">
                                <?php the_title(); ?>
                            </h3>
                            <p class="project-details">
                                <?php the_excerpt(); ?>
                            </p>
                            <p class="project-text">
                                Check it Out
                            </p>
                        </a>
                    </li>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                // Default all projects if none are added yet
                ?>
                <li class="card-item">
                    <a href="works02.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/kamakura.jpg" alt="kamakura.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title fz18">
                            株式会社カヤック<br>UX企画発表
                        </h3>
                        <p class="project-details">
                            学校のUX授業で、鎌倉の小学生向けに楽しみながらごみ問題を学べる授業を企画し、株式会社カヤック「つくっていいとも!」で発表しました。制作期間は4週間、イベントで1位を受賞することができました。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works04.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/ui_ux_design.jpg" alt="ui_ux_design.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            Yahoo乗換アプリ:<br>UI/UX変革プロジェクト
                        </h3>
                        <p class="project-details">
                            学校のUXデザイン授業で、Yahoo!乗換案内アプリのUI/UX改善に取り組みました。ユーザーインタビューやペルソナ、カスタマージャーニー作成を担当し、最終案を統合。オンボーディングセクションの設計も行い、プロジェクト期間は1ヶ月でした。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works05.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/the_one_ring.jpg" alt="the_one_ring.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            The One Ring Modeling
                        </h3>
                        <p class="project-details">
                            Blenderを使用して『ロード・オブ・ザ・リング』の「一つの指輪」を初制作しました。中つ国の地図を背景に、指輪に細かな傷や汚れを加えリアリティを追求。約2時間で基本操作とレンダリング技術を習得し、今後さらに高品質な制作を目指します。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works07.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/virtual_cosmos.jpg" alt="virtual_cosmos.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            Virtual Cosmos
                        </h3>
                        <p class="project-details">
                            TouchDesignerを使用し、「宇宙×バーチャル×星雲」をテーマに制作しました。バーチャルコンサートでの使用を想定し、スマホ連動による球体の光や動き、カメラ操作を実現。約2時間でインタラクティブな表現を仕上げました。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works06.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/your_name.jpg" alt="your_name.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            『君の名のは。』<br>OPアニメーション
                        </h3>
                        <p class="project-details">
                            学生時代に学んだアニメーションの知識を活かし、映画『君の名は。』のオープニングシーンを手描きで再現しました。1週間かけて、繊細な感情表現や色使いを分析し、自分のスタイルで表現。創造力とアニメーション理解を深める経験となりました。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <li class="card-item">
                    <a href="works08.html" class="card-block project-card-fadein" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/animation.jpg" alt="animation.jpg" loading="lazy" class="project-pic" />
                        <h3 class="project-title">
                            Night Life
                        </h3>
                        <p class="project-details">
                            カレッジ時代のデジタルアーツ卒業制作で、サブキャラクターデザインと映像編集を担当しました。先生が選んだ詩をテーマに1分間のアニメーションを制作。英語でのチーム制作に苦労しましたが、支えを受けて完成。制作期間は約1ヶ月です。
                        </p>
                        <p class="project-text">
                            Check it Out
                        </p>
                    </a>
                </li>
                <?php
            endif;
            ?>
        </ul>
    </div>
</section>