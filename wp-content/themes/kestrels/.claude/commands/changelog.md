Update CHANGELOG.md with work done in this conversation.

1. Read CHANGELOG.md to find the date of the most recent entry
2. Run `git log --format="%ad %s" --date=short --no-merges` to see commits since that date
3. Review the current conversation for any work done that may not yet be committed
4. Group all changes under today's date using Keep a Changelog conventions:
   - **Added** – new features or files
   - **Changed** – changes to existing functionality
   - **Fixed** – bug fixes
   - **Removed** – removed features or files
5. Write concise, developer-facing bullet points (skip trivial commits like "compile assets")
6. Prepend the new dated section to CHANGELOG.md, below the header block and above the previous most-recent entry
7. Only create sections that have content — omit empty ones
