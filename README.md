# mklicense - generate a valid license

Global installation:

    composer global require --dev gabrielbarros/mklicense

Once it's installed, then the executable script `mklicense` will be available at `~/.config/composer/vendor/bin/mklicense`.

On Linux systems if you specify the folder `~/.config/composer/vendor/bin` in your `$PATH`, you'll be able to execute the global bin files directly from your terminal:

    $ mklicense

If you prefer, you can install it only for the current project:

    composer require --dev gabrielbarros/mklicense

Then run the following command to generate a license file in the current directory:

    vendor/bin/mklicense

Usage:

    mklicense agpl-3.0     # GNU Affero General Public License v3.0
    mklicense apache-2.0   # Apache License 2.0
    mklicense bsd-2-clause # BSD 2-Clause "Simplified" License
    mklicense bsd-3-clause # BSD 3-Clause "New" or "Revised" License
    mklicense bsl-1.0      # Boost Software License 1.0
    mklicense cc0-1.0      # Creative Commons Zero v1.0 Universal
    mklicense epl-2.0      # Eclipse Public License 2.0
    mklicense gpl-2.0      # GNU General Public License v2.0
    mklicense gpl-3.0      # GNU General Public License v3.0
    mklicense lgpl-2.1     # GNU Lesser General Public License v2.1
    mklicense mit          # MIT License <-- The most popular license on GitHub!
    mklicense mpl-2.0      # Mozilla Public License 2.0
    mklicense unlicense    # The Unlicense

You can also type the index instead of the license name:

    mklicense 10

To see all available licenses and their indexes, just type:

    mklicense

Some licenses will include the current year and your name which will be read from `git config user.name`. Just press <kbd>Enter</kbd> to confirm the default values.
