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
sessions = []
events = []
event = []

lastSession = {
  'id': 1,
  'events': []
}
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
            'id': lastEvent[1],
            'name': ' '.join(lastEvent[2:]),
            'swims': event
          })

          # If new session, add to list and create blank session
          event_number = line[0].split()[1]
          if (len(event_number) > 2):
            # Assume we're using 101/201 numbering convention
            if (int(event_number[:-2]) != lastSession['id']):
              lastSession['events'] = events
              sessions.append(lastSession)

              events = []
              lastSession = {
                'id': int(event_number[:-2]),
                'events': []
              }

          event = []
        lastEvent = line[0].split()
        print(line[0].split())
        event = []
      else:
        if not (len(lastEvent) > 2 and lastEvent[2] == 'FINAL'):
          # print(line)
          if (len(line) == 4):
            event.append({
              'name': line[1].strip(),
              'age': None,
              'club': line[2].strip(),
              'sub_time': None,
              'blank_time': ''
            })
          elif (len(line) == 5):
            event.append({
              'name': line[1].strip(),
              'age': line[2].strip(),
              'club': line[3].strip(),
              'sub_time': None,
              'blank_time': ''
            })
          elif (len(line) == 6):
            event.append({
              'name': line[1].strip(),
              'age': line[2].strip(),
              'club': line[3].strip(),
              'sub_time': line[4].strip(),
              'blank_time': ''
            })
        else:
          event.append({
            'name': "",
            'club': ""
          })

if len(event) > 0:
  events.append({
    'event': ' '.join(lastEvent),
    'id': lastEvent[1],
    'name': ' '.join(lastEvent[2:]),
    'swims': event
  })

  lastSession['events'] = events
  sessions.append(lastSession)

# json_data = json.dumps(data)
# print(json_data)

json_dict = {
  'sessions': sessions
}

with open('data.json', 'w') as f:
  json.dump(json_dict, f)