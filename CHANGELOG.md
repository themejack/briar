# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [1.1.8] - 2016-01-03
### Added
- Change log
- Branch for theme developers. Master branch follows WordPress.org releases.

### Fixed
- Fix Briar_Sanitize_Select constructor name

### Removed
- Remove development files from master branch

## [1.1.7] - 2015-12-18
### Changed
- Remove 'featured-image-header' tag
- Remove some unnecessary translations
- Prefix add_image_size() handlers with theme slug
- Use the_content() function in content-status.php
- Prefix customizer sanitize functions

### Removed
- Slicejack RSS dashboard widget

## [1.1.6] - 2015-12-11
### Fixed
- Define $content_width variable on after_setup_theme action hook

### Changed
- Remove browsehappy script
- Remove global variables
- Remove minimized files
- Prefix scripts and styles handlers with theme slug
- Replace webfontloader.js link with jsdelivr.net link
- Replace 'sj' prefix to 'slicejack'

### Removed
- Remove deprecated functions
- POT file

## [1.1.5] - 2015-11-04
### Fixed
- PHP version <5.4 errors
- Regenerate POT file

## [1.1.4] - 2015-10-29
### Fixed
- Fix textdomains

## [1.1.3] - 2015-10-15
### Fixed
- Fix WordPress coding standards errors and warnings

## [1.1.2] - 2015-10-14
### Added
- All scripts and styles minimized files

### Changed
- Prefix files with theme slug

## [1.1.1] - 2015-10-08
### Fixed
- Fix browserhappy url variable

## [1.1] - 2015-08-19
### Added
- Add support for chat, gallery, audio, video and status post format
- Footer social icons style
- Comment form style
- Add title on footer link
- Implement javascript fonts loading
- Add license
- TinyMCE editor style
- font loading plugin for TinyMCE

### Changed
- Change theme name
- 'sj' prefix to 'briar'

### Fixed
- Turn on rss caching for slicejack dashboard
- Remove html folder and fix google plus and vimeo social icon class
- Remove commented code and fix index.php html structure
- Fix full width heading on layout with sidebar
- Fix full width heading on home and archives page
- Some stylings
- Fix README.md footer image position
- Fix textdomains
- Fix license

## [1.0.0] - 2015-06-10
### Added
- Initial github release