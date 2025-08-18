<?php
/**
 * Template Name: Blog Single Page
 * Description: Custom blog single page template based on SVG design
 */

get_header();
?>

<?php get_template_part('sections/bloHeading'); ?>


<section class="single-page-container">
  <!-- Left Section -->
  <div class="left-single-blog">

    <?php if (have_posts()):
      while (have_posts()):
        the_post(); ?>
        <div class="date">
          <div class="yellow-cercel"></div>
          <span>
            <?php echo get_the_date(); ?>
          </span>
        </div>
        <div class="single-blog-details-title"><?php echo get_the_title(); ?></div>

        <?php
        $author_id = get_the_author_meta('ID');
        $avatar_url = get_avatar_url($author_id, ['size' => 50]);

        if (!$avatar_url) {
          $avatar_url = 'https://via.placeholder.com/60';
        }
        ?>
        <div class="single-blog-author">
          <img src="<?php echo esc_url($avatar_url); ?>" alt="author" width="60" height="60" />
          <div>By <?php the_author(); ?></div>
        </div>
        <div class="single-blog-img-wrapper">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail('full', ['class' => 'single-blog-img']); ?>
          <?php else: ?>
            <img src="https://via.placeholder.com/800x400" alt="Blog Image" class="single-blog-img" />
          <?php endif; ?>
        </div>

        <div class="paragraph">
          <?php
          the_content();
          ?>
        </div>

      <div class="tags">
  <strong>Tags:</strong>
  <?php
    $tags = get_the_tags();
    if ($tags) {
      foreach ($tags as $tag) {
        echo '<span>' . esc_html($tag->name) . '</span>';
      }
    } else {
      echo '<span>No Tags</span>';
    }
  ?>
</div>


        <div class="blog-share">
          <div class="share">
            <strong>Share:</strong>
          </div>
          <div class="blog-social-links">
            <a href="https://twitter.com/intent/tweet?url=&text=<?php the_permalink(); ?>" target="_blank">
              <i class="fa-brands fa-square-twitter"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
              <i class="fa-brands fa-facebook"></i>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" target="_blank">
              <i class="fa-brands fa-linkedin"></i>
            </a>
            <a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" target="_blank">
              <i class="fa-brands fa-whatsapp"></i>
            </a>
          </div>
        </div>

        <!-- user buttom detial -->
        <div class="bottom-user">
          <?php
          $author_id = get_the_author_meta('ID');
          $avatar_url = get_avatar_url($author_id, ['size' => 70]);
          $author_name = get_the_author();
          $author_description = get_the_author_meta('description', $author_id);

          if (!$avatar_url) {
            $avatar_url = 'https://via.placeholder.com/70';
          }
          ?>

          <img src="<?php echo esc_url($avatar_url); ?>" alt="">
          <div class="user-information-section">
            <div class="bottom-user-info">

              <?php if (!empty($author_name)): ?>
                <strong><?php echo esc_html($author_name); ?></strong>
              <?php else: ?>
                <strong>No author name found.</strong>
              <?php endif; ?>

              <?php if (!empty($author_description)): ?>
                <p><?php echo esc_html($author_description); ?></p>
              <?php else: ?>
                <p>No author description available.</p>
              <?php endif; ?>
            </div>
            <div class="socil-icon">
              <div class="user-social-links">
                <?php if (get_the_author_meta('user_url')): ?>
                  <a href="<?php echo get_the_author_meta('user_url'); ?>">
                    <i class="fa-brands fa-square-twitter"></i>
                  </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('user_url')): ?>
                  <a href="<?php echo get_the_author_meta('user_url'); ?>">
                    <i class="fa-brands fa-facebook"></i>
                  </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('user_url')): ?>
                  <a href="<?php echo get_the_author_meta('user_url'); ?>">
                    <i class="fa-brands fa-linkedin"></i>
                  </a>
                <?php endif; ?>

                <?php if (get_the_author_meta('user_url')): ?>
                  <a href="<?php echo get_the_author_meta('user_url'); ?>">
                    <i class="fa-brands fa-square-instagram"></i>
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

            <!-- //  show comment list
          // wp_list_comments(array(
          //      'style' => 'div',
          //      'avatar_size' => 50,
          //      'callback' => null,
          // ), get_comments(array(
          //   'post_id' => get_the_ID()
          // ))); -->



<!-- Comment Section -->
<div class="comments">
  <?php
  $get_comment_count = get_comments_number();
  if ($get_comment_count > 0):
    echo '<h3>Comments: (' . esc_html($get_comment_count) . ')</h3>';
    echo '<div class="divider"></div>';
  endif;

  $parent_comments = get_comments([
    'post_id' => get_the_ID(),
    'status' => 'approve',
    'orderby' => 'comment_date',
    'order' => 'ASC',
    'parent' => 0
  ]);
  ?>

  <?php if ($parent_comments): ?>
    <div class="comment-list">
      <?php foreach ($parent_comments as $comment): ?>
        <div class="comment-item" id="comment-<?php echo $comment->comment_ID; ?>">
          <div class="comment-left">
            <?php echo get_avatar($comment, 70, ['class' => 'comment-avatar-image']); ?>
          </div>
          <div class="comment-right">
            <div class="comment-header">
              <strong><?php echo esc_html($comment->comment_author); ?></strong>
              <span class="time">
                <?php echo esc_html(human_time_diff(strtotime($comment->comment_date), current_time('timestamp'))) ?> ago
              </span>
            </div>
            <p class="comment-text"><?php echo esc_html($comment->comment_content); ?></p>
            <a href="#" class="reply-btn">
              <i class="fa-solid fa-reply"></i> Reply
            </a>

            <!-- Replies -->
            <?php
            $replies = get_comments([
              'post_id' => get_the_ID(),
              'status' => 'approve',
              'orderby' => 'comment_date',
              'order' => 'ASC',
              'parent' => $comment->comment_ID
            ]);
            ?>
            <?php if ($replies): ?>
              <?php foreach ($replies as $reply): ?>
                <div class="comment-item reply" id="comment-<?php echo $reply->comment_ID; ?>">
                  <?php echo get_avatar($reply, 50); ?>
                  <div class="comment-content">
                    <div class="comment-header">
                      <strong><?php echo esc_html($reply->comment_author); ?></strong>
                      <span class="time"><?php echo esc_html(human_time_diff(strtotime($reply->comment_date), current_time('timestamp'))) ?> ago</span>
                    </div>
                    <p><?php echo esc_html($reply->comment_content); ?></p>
                    <button class="reply-btn">
                      <i class="fa-solid fa-reply"></i> Reply
                    </button>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>

          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>


 <!-- Comment form -->
   <?php 
       comment_form([
            'fields' => [
              'author' => '<div class="form-row"><input type="text" id="author" name="author"  placeholder="Your Name">',
              'email' => '<input type="email" id="email" name="email" placeholder="Your Email">
            </div>'
            ],
            'comment_field' => '<div class="form-row">
              <textarea id="comment" name="comment" placeholder="Your Comment"></textarea>
            </div>',
            'class_submit' => 'comment-button',
            'label_submit' => 'Post Comment'
       ]);
   
  ?>
      <?php endwhile; else: ?>
      <p>No posts found.</p>
    <?php endif; ?>

  </div>

  <!-- Right Section Sidebar -->
 <?php get_sidebar(); ?>

</section>


<?php
get_footer();
?>