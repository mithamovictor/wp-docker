module.exports = {
  content: ['./**/*.php'],
  darkMode: 'class', // or 'media' or 'class' or false
  theme: {
    container: {
			center: true,
      padding: '1rem',
    },
    backgroundColor: theme => ({
      ...theme('colors'),
      'altblack' : '#0A0A0A',
      'altwhite' : '#FEFEFE',
      'altgray'  : '#CECECE',
      'altdgray' : '#191A1D',
      'altmaroon': '#2B0000',
      'altred'   : '#FF2A2A',
      'altdred'  : '#DE495A',
      'altcard'  : '#181818',
      'altdark'  : '#121212'
    }),
    textColor: font => ({
      ...font('colors'),
      'altblack' : '#0A0A0A',
      'altwhite' : '#FEFEFE',
      'altgray'  : '#CECECE',
      'altdgray' : '#191A1D',
      'altmaroon': '#2B0000',
      'altred'   : '#FF2A2A',
      'altdred'  : '#DE495A',
      'altcard'  : '#181818',
      'altdark'  : '#121212'
    }),
    borderColor: border => ({
      ...border('colors'),
      'altblack' : '#0A0A0A',
      'altwhite' : '#FEFEFE',
      'altgray'  : '#CECECE',
      'altdgray' : '#191A1D',
      'altmaroon': '#2B0000',
      'altred'   : '#FF2A2A',
      'altdred'  : '#DE495A',
      'altcard'  : '#181818',
      'altdark'  : '#121212'
    }),
    extend: {
			zIndex: {
				'1': '1',
				'2': '2',
				'3': '3',
				'4': '4',
				'5': '5',
			},
			transitionProperty: {
				'width': 'width'
			}
		},
  },
	corePlugins: {
    maxHeight: true,
	},
  variants: {
    extend: {
      backgroundColor: [
        'even',
        'odd'
      ],
      backgroundOpacity: [
        'even',
        'odd'
      ],
      borderColor: [
        'hover',
        'focus',
        'active'
      ]
    }
  },
  plugins: [
    require('flowbite/plugin')
  ]
}
