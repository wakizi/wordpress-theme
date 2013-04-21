                </div>
            <?php if ('' !== $GLOBALS['_wakizi_sidebar_context']): ?>
                <div class="span3 sidebar sidebar-context" role="complementary">
                    <a href="/unterstuetzen/" class="help-bubble">Wollen Sie uns helfen?</a>
                    <?php echo $GLOBALS['_wakizi_sidebar_context']; ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>
