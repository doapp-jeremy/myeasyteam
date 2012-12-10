set :application, "myeasyteam"
set :scm, "git"
set :scm_username, "doapp-jeremy"  # The server's user for deploys
set :scm_passphrase, "bond007"  # The deploy user's password
set :repository, "git@github.com:#{scm_username}/myeasyteam.git"  # Your clone URL
set :user, "deploy"

namespace :deploy do
  task :finalize_update, :roles => :app do
    run "cd #{release_path}/webapp/app/Config/ && ln -sf core_#{stage}.php core.php"
    run "cd #{release_path}/webapp/app/Config/ && ln -sf database_#{stage}.php database.php"
    #run "cd #{release_path}/app/config && ln -sf ./facebook_#{stage}.php ./facebook.php"   
              
    # write repository revision
    write_revision
    clearobjcache
  end
end

