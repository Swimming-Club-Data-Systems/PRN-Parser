"""
USE: python <PROGNAME> (options) 
OPTIONS:
    -h : print this help message and exit
    -d FILE : use FILE as data to create a new lexicon file
    -t FILE : apply lexicon to test data in FILE
"""
################################################################

import sys, re, getopt, json
from collections import Counter

################################################################
# Command line options handling, and help

opts, args = getopt.getopt(sys.argv[1:], 'hd:t:')
opts = dict(opts)

def printHelp():
    progname = sys.argv[0]
    progname = progname.split('/')[-1] # strip out extended path
    help = __doc__.replace('<PROGNAME>', progname, 1)
    print('-' * 60, help, '-' * 60, file=sys.stderr)
    sys.exit()
    
if '-h' in opts:
    printHelp()

if '-d' not in opts:
    print("\n** ERROR: must specify the SPORTSYSTEMS *.PRN data file (opt: -d FILE) **", file=sys.stderr)
    printHelp()

if len(args) > 0:
    print("\n** ERROR: no arg files - only options! **", file=sys.stderr)
    printHelp()

################################################################

data = {}
events = []
event = []
lastEvent = {}

with open(opts['-d'], "r", encoding = "utf-8") as input_file:
  for line in input_file:
    line = line.replace("\r\n", "")
    line = line.replace("\n", "")
    #line = line.split()
    line = re.sub(r"\t+", "\t", line)
    line = line.split("\t")

    if (len(line) > 0):
      if line[0][:5] == 'EVENT':
        # This is a new event to handle
        #print(' '.join(line))
        if len(event) > 0:
          events.append({
            'event': ' '.join(lastEvent),
            'swims': event
          })
          event = []
        lastEvent = line[0].split()
        event = []
      else:
        if not (len(lastEvent) > 2 and lastEvent[2] == 'FINAL'):
          event.append({
            'name': line[1],
            'club': line[2]
          })
        else:
          event.append({
            'name': "",
            'club': ""
          })

if len(event) > 0:
  events.append({
    'event': ' '.join(lastEvent),
    'swims': event
  })

# json_data = json.dumps(data)
# print(json_data)

with open('data.json', 'w') as f:
  json.dump(events, f)