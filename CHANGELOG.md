Changelog
=========

## 3.0.3 - 2018-09-20

### Added
- Added `dukt\social\github\loginproviders\Github::getDefaultUserFieldMapping()`.

### Changed
- Changed `dukt\social\github\loginproviders\Github::getOauthProvider()` method’s visibility to `public`.
- Renamed `dukt\social\github\loginproviders\Github::getDefaultScope()` to `dukt\social\github\loginproviders\Github::getDefaultOauthScope()`.
- Updated `dukt/social` composer dependency to `^2.0.0-beta.10`.
- Updated `dukt\social\github\loginproviders\Github::getOauthProvider()` to take into account the new OAuth provider config introduced in Social 2.0.0-beta.10.
- Removed `dukt\social\github\loginproviders\Github::getClient()`.
- Removed `dukt\social\github\loginproviders\Github::getProfile()`.
- Removed `dukt\social\github\loginproviders\Github::getRemoteEmail()`.

## 3.0.2 - 2018-05-18

### Changed
- Typed `dukt\social\linkedin\loginproviders\Linkedin::getName()`’s return to string.

## 3.0.1 - 2017-12-17

### Changed
- Updated to require craftcms/cms `^3.0.0-RC1`.

## 3.0.0 - 2017-10-01

### Added
- Added Social 2 compatibility.
- Added Craft 3 compatibility.