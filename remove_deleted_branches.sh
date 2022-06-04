echo "Removing branches that were deleted on remote, but are still present on local"
echo "Make sure you are on the `main` branch"
git checkout main
git fetch -p && git branch -vv | awk '/: gone]/{print $1}' | xargs git branch -d
echo "Done" 
